<?php
$server = "localhost"; //localhost or ip address
$username = "root";
$password = "";
$database = "minnowshare";

try{
    $con = mysqli_connect($server, $username, $password, $database);
} catch(Exception $errormsg){
    trigger_error( $errormsg->getMessage());
}


function escape_data($name){
    global $con;
    $name = trim($name);
    $name = mysqli_real_escape_string($con, $name);
    return strip_tags($name);
}

function close_connection(){
    global $con;
    mysqli_close($con);
}

?>