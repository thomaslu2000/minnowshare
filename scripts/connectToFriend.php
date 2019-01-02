<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($u)){
    $u = $_SESSION['userid'];
}
if(!isset($f)){
    $f = $_GET['user'];
}



if(is_dir("./includes/")){
    require_once("./includes/functions.php");
    require_once("./includes/connection.php");
} else{
    require_once("../includes/functions.php");
    require_once("../includes/connection.php");
}


function back_friend($m){
    global $f;
    if(file_exists('profile.php')) $dir = 'profile.php';
    else $dir = '.././profile.php';
    close_connection_and_leave($dir . "?user=$f", $m);
    exit();
}

$query = "SELECT status FROM friends WHERE id_1=$u AND id_2=$f";

if (! $run = mysqli_query($con, $query)){
    echo 'query failed ' . $query;
    exit();
}
$affected_rows = mysqli_affected_rows($con);

if($affected_rows==0) $status='none';
elseif($affected_rows == 1) $status=mysqli_fetch_assoc($run)['status'];
else back_friend('multiple records with same ids');
?>