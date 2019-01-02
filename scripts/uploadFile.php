<?php
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("../includes/functions.php");
function back($m){
    close_connection_and_leave("../upload.php", $m);
    exit();
}
require("../includes/connection.php");

if(!isset($_SESSION['userid'])) back('Please Log In and Try Again');
if (!isset($_POST['submitted'], $_POST['title'], $_POST['sharetype'])) back('Please comlpete the submission form');

$path = ".././uploads/";
if ( !is_dir($path)) mkdir($path);

$all = FALSE;
if($_POST['sharetype'] == "friends all"){
    $_POST['sharetype'] = "friends";
    $all = TRUE;
}

$path = $path . $_POST['sharetype'] . "/";
if ( !is_dir($path)) mkdir($path);

$path = $path . $_SESSION['userid'] . "/";
if ( !is_dir($path)) mkdir($path);

$p = pathinfo($_FILES['file']["name"]);
$n = $p['filename'];

if ($_FILES["file"]["size"] > 500000000) {
    back("Filesize limited to 500mb");
} 

while(glob ($path . $n . '.' . $p['extension'])){
    $end = explode("-", $n);
    $end = end($end);
    if(is_numeric($end)){
        $n = substr($n, 0, -strlen($end)) . ($end + 1);
    } else{
        $n = $n . '-1';
    }
}

$name = $n . '.' . $p['extension'];

$u = $_SESSION['userid'];
$t = escape_data($_POST['title']);

$table = $_POST['sharetype'] . '_uploads';

$c = 'NULL';
$d = 'NULL';
if($_POST['short']) $c = escape_data($_POST['short']);
if($_POST['description']) $d = escape_data($_POST['description']);

$query = "INSERT INTO $table (item_id, owner_id, title, short, description, file_name) VALUES (NULL, $u, '$t', '$c', '$d', '$name')";

if (!mysqli_query($con, $query)) {
    back('Error: File With That Title Already ');
}
$item_id = mysqli_insert_id($con);
if ($all and $friends_query = mysqli_query($con, "SELECT id_2 FROM friends WHERE id_1=$u AND status='friended'")){
    while($friend = mysqli_fetch_assoc($friends_query)){
        $fid = $friend['id_2'];
        mysqli_query($con, "INSERT INTO access_files (user, item_id, owner_id, title) VALUES ($fid, $item_id, $u, '$t')");
    }
}

if(! move_uploaded_file($_FILES["file"]["tmp_name"], $path . $name)){
    $query = "DELETE FROM $table WHERE owner_id=$u AND file_name='$name'";
    mysqli_query($con, $query);
    back('Error Uploading File');
    
}

if(isset($_FILES["photo"]) and $_FILES["photo"]['name']){
    $photo = $_FILES['photo'];
    if(!get_file_type($photo["name"]) == 'image' || !move_uploaded_file($photo["tmp_name"], $path  . $n . '^@&$.' . pathinfo($photo["name"])['extension']))
        back('Successfully Uploaded, but Error Uploading Photo');
}

header("Location: ../file.php?share=".$_POST['sharetype']."&file=$item_id");
?>