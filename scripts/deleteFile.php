<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("../includes/functions.php");
require("../includes/connection.php");
function back($m){
    close_connection_and_leave("..\myprofile.php", $m);
    exit();
}

    
if(!isset($_SESSION['userid'])){
    
    back();
    exit(); 
}

$u = $_SESSION['userid'];
$f = $_POST['file'];
$sharetype = $_POST['share'];


if (! $name = mysqli_query($con, "SELECT file_name FROM $sharetype" . "_uploads WHERE item_id=$f AND owner_id=$u") or mysqli_affected_rows($con) != 1){
    back("Error finding file");
}
$name = mysqli_fetch_assoc($name)['file_name'];

if(! mysqli_query($con, "DELETE FROM $sharetype". "_uploads WHERE item_id=$f")) back("Error Deleting From Database");

$path_to_file = "../uploads/$sharetype/$u/";

$img = $path_to_file . $file_info['filename'] . '^@&$' . ".*";
$img = glob($img);
if($img and !unlink($img[0])){
    back("Error Deleting Image");
}

if(!unlink($path_to_file . $name)) back('Error Deleting File '.$path_to_file . $name);
back("File Successfully Deleted!");
?>