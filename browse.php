<?php
session_start();
include("header.php");
include("scripts/displayFiles.php");

if(isset($_GET['view'])){
    $view = $_GET['view'];
} else $view = 'none';

?>

<div class="container">
    <div class="row">
        
        <div class="col-12 col-sm-9" style="border-right: 1px solid #e8e8e8;">
            <?php 
            if(!$logged_in or $view == 'public'){
                echo "<br><h2 id='public-display'>Public Uploads: </h2><br>";
                display_files(array('sharetype'=>'public', 'recs_per_page'=>6));
                
            } elseif($view == 'friends'){
                echo "<br><h2 id='friends-display'>Uploads From Friends: </h2><br>";
                display_files(array('sharetype'=>'friends', 'recs_per_page'=>6, 'user'=>$_SESSION['userid']));
                
            } elseif($view == 'private'){
                echo "<br><h2 id='private-display'>My Private Uploads: </h2><br>";
                display_files(array('sharetype'=>'private', 'recs_per_page'=>6, 'user'=>$_SESSION['userid']));
            } else{
                echo "<br><h2 id='public-display'>Public Uploads: </h2><br>";
                display_files(array('sharetype'=>'public', 'recs_per_page'=>3));
                
                echo "<br><h2 id='friends-display'>Uploads Shared By Friends: </h2><br>";
                
                display_files(array('sharetype'=>'friends', 'recs_per_page'=>3, 'user'=>$_SESSION['userid']));
                
                echo "<br><h2 id='private-display'>My Private Uploads: </h2><br>";
                display_files(array('sharetype'=>'private', 'recs_per_page'=>3, 'user'=>$_SESSION['userid']));
                
            }
            
            ?>
        </div>
        <br><br>
        <div class="col-12 col-sm-3 bg-s"> 
           <div class="container">
                <div class="list-group" style="font-size: 1em;">
                 <a class="list-group-item list-group-item-secondary bg-site-blue" href="browse.php"><b>Browse Files</b></a>
                      <?php if($logged_in){?>
                          <a class="list-group-item <?php if($view=='public') echo 'active'; ?>" href="browse.php?view=public">Public Files</a>
                          <a class="list-group-item <?php if($view=='friends') echo 'active'; ?>" href="browse.php?view=friends">Files From Friends</a>
                          <a class="list-group-item <?php if($view=='private') echo 'active'; ?>" href="browse.php?view=private">My Files</a>
                      <?php } else{ ?>
                          <a class="list-group-item" href="login.php"><b>Log In for More Options</b></a>
                      <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>