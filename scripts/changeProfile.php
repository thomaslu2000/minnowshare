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

if(!isset($_SESSION['userid'], $_POST['submitted'], $_FILES['profileFile'])){
    back('No file found');
}
$n = $_FILES["profileFile"]["name"];
if (get_file_type($n)!='image'){
    back('Image Format is Not Supported');
}

$ext = explode(".", $n);
$ext = strtolower(end($ext));

$path = ".././profile-pics/";

if ( ! is_dir($path)) {
    mkdir($path);
}

$p = glob ($path . $_SESSION['userid'] . ".*");
if ($p) {
    unlink($p[0]);
}
if(move_uploaded_file($_FILES["profileFile"]["tmp_name"], $path.strval($_SESSION["userid"]).'.'.$ext)){
    back("Successfully Updated (May Need to Reload)");
}
else{
    back('File Upload Failed');
}
?>