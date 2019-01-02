<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$item_id = $_POST["item_id"];
$item_title = $_POST["item_title"];
$user_id = $_POST["user_id"];
$owner_id = $_POST["owner_id"];

require_once("../includes/connection.php");
require_once("../includes/functions.php");

function back($m){
    close_connection_and_leave($_POST["url"], $m, "access");
    exit();
}

mysqli_query($con, "SELECT null FROM friends_uploads WHERE item_id=$item_id AND owner_id=$owner_id");

if (mysqli_affected_rows($con) != 1) back("Error Finding File");

if($_POST["has_access"]){
    
    if(! mysqli_query($con, "DELETE FROM access_files WHERE user=$user_id AND item_id=$item_id AND owner_id=$owner_id")) back("Error Deleting File");
    
    back("Permission Successfully Removed");
    
} else{
    
    mysqli_query($con, "SELECT null FROM access_files WHERE user=$user_id AND item_id=$item_id AND owner_id=$owner_id");
    
    if (mysqli_affected_rows($con) != 0) back("Permission Already Exists");
    
    if (! mysqli_query($con, "INSERT INTO access_files (user, item_id, owner_id, title) VALUES ($user_id, $item_id,$owner_id, '$item_title')")) back("Error Adding Permission");
    
    back("Permission Successfully Added");
    
}
?>