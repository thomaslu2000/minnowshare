<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    
if(!isset($_SESSION['userid'], $_POST['friendid'])){
    
    header('Location: .././myprofile.php');
    exit(); 
}

$u = $_SESSION['userid'];
$f = $_POST['friendid'];

require("connectToFriend.php");

if($status=='friended'){
    if(mysqli_query($con, "DELETE FROM friends WHERE id_1=$u AND id_2=$f") and mysqli_query($con, "DELETE FROM friends WHERE id_1=$f AND id_2=$u")) back_friend('Friendship Successfully Revoked!');
    else back_friend('Friendship Could Not Be Removed');
} else back_friend('Cannot Unfriend');

?>