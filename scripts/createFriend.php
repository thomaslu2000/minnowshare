<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['userid'], $_POST['friendid'])){
    header('Location: ../myprofile.php');
    exit(); 
}

$u = $_SESSION['userid'];
$f = $_POST['friendid'];

require("connectToFriend.php");

switch($status){
    case 'none':
        $insert_query = "INSERT INTO friends (id_1, id_2, status) VALUES ($u, $f, 'sent'), ($f, $u, 'received')";
        if(mysqli_query($con, $insert_query)) back_friend('Request Successfully sent!');
        else back_friend('could not insert into array '.$insert_query);
        break;
    case 'received':
        if(mysqli_query($con, "UPDATE friends SET status='friended' WHERE id_1=$u AND id_2=$f") and 
           mysqli_query($con, "UPDATE friends SET status='friended' WHERE id_1=$f AND id_2=$u")) 
            back_friend('Friend Successfully Made!');
        else back_friend('Error Accepting Friend Request');
        break;
    case 'sent':
        back_friend('Friend Request Already Sent!');
        break;
    case 'friended':
        back_friend('Already Friended!');
        break;
}

?>