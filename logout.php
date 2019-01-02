<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    unset($_COOKIE['userid']);
    unset($_COOKIE['username']);
    setcookie(session_name(), '', time()-300,'/', '',0);
    setcookie("userid", "", time()-3600, "/");
    setcookie("username", "", time()-3600, "/");
       
    header("Location: login.php");
?>
