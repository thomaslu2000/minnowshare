<!doctype html>
<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("includes/functions.php");
$logged_in = isset($_SESSION['userid'], $_SESSION['username']);

if(!$logged_in && isset($_COOKIE['userid'], $_COOKIE['username'])){
    $_SESSION['userid'] = $_COOKIE['userid'];
    $_SESSION['username'] = $_COOKIE['username'];
}
?>

<html lang="en-US">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 
<!-- Set the page to the width of the device and set the zoon level -->
<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>MinnowShare</title>
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">  
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="./css/custom-bootstrap.css" type="text/css">
</head>

<body align=center style="background-color: #FFF">

<!--<div class="container-fluid" id="navbar-div" style="width: 100%">-->
    <nav class="navbar navbar-expand-md navbar-light bg-site-blue">
      <a class="navbar-brand" href="index.php"><img style="max-height: 80px;" src="images/minnowshare.png" alt="MinnowShare"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="main-navbar">
        <ul class="navbar-nav mr-auto">
         <?php
            if (isset($_SESSION['userid'])){
                $menu_refs = array("Home"=>"index",  "Browse"=>"browse", "Profile"=>"myprofile","Upload"=>'upload', 'Logout'=>'logout');
            } else{
                $menu_refs = array("Home"=>"index", "Browse"=>"browse", 'Login'=>'login', 'Register'=>'register');
            }   

            foreach($menu_refs as $page=>$ref){
                $ref_page = $ref . '.php';
                echo "<li class='nav-item " . returnTextIfPageMatches('active', $ref) . "'> <a class='nav-link' href='$ref_page'><span>$page</span></a></li>";
            }
        ?>
        </ul>
        <?php include("scripts/searchBar.php"); ?>
      </div>
    </nav>
<!--</div>-->

<br>


<?php 
    if(isset($_GET['message'])){
        $m = $_GET['message'];
        echo 
            "<div align=center class='alert alert-warning'>
                <h2> $m </h2>
            </div>";
    }

    if(isset($_GET['p'])){
        foreach(array('last_ind_public', 'last_ind_private', 'last_ind_friends') as $ind){
            if (isset($_GET[$ind])) $_SESSION[$ind] = $_GET[$ind];
        }
    } else{
        foreach(array('last_ind_public', 'last_ind_private', 'last_ind_friends') as $ind){
            $_SESSION[$ind] = 0;
        }
    }
    ?>
    