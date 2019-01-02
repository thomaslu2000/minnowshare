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

    if(!isset($_SESSION['userid']) || !isset($_POST['submitted'])){
        back('');
    }
    if (preg_match ('%^[A-Za-z0-9]\S{4,20}$%', stripslashes(trim($_POST['newUsername'])))) {
            $new_user = escape_data($_POST['newUsername']);
        } else {
            back('Usernames Must be Alphanumeric Between 5 and 20 Characters!');
    }
    $u = $_SESSION['userid'];
    $query = "UPDATE users SET username = '$new_user' WHERE userid = $u";

    if (mysqli_query($con, $query)) {
        $_SESSION['username'] = $new_user;
        header("Location: ..\myprofile.php");
    } else {
        back('Error updating record');
    }

    back('Username Changed Successfully!');

?>