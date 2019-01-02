<?php
include("header.php");
include("./scripts/displayFiles.php");

if(!isset($_GET['user'])){
    header("Location: browse.php");
    exit();
}

$user = $_GET['user'];
require_once("./includes/connection.php");
if(is_numeric($user) and $get_name = mysqli_query($con, "SELECT username FROM users WHERE userid=$user") and mysqli_affected_rows($con) == 1){
    $f_name = mysqli_fetch_assoc($get_name)['username'];
} else  {
        echo "Error finding user";
        exit();
}

if($logged_in = isset($_SESSION['userid'], $_SESSION['username'])){
    
    if($_SESSION['userid'] == $user){
        header("Location: myprofile.php");
        exit();
    }
    
    $status='none';
    include("./scripts/connectToFriend.php");
    switch($status){
        case 'none':
            $f_status="Not Friended";
            $f_button="Send Friend Request";
            $disabled = '';
            break;
        case 'sent':
            $f_status="Friend Request Sent!";
            $f_button="Request Already Sent!";
            $disabled = 'disabled';
            break;
        case 'received':
            $f_status="Received Friend Request! <span class='badge badge-primary badge-pill'>!</span>";
            $f_button="Accept Friend Request";
            $disabled = '';
            break;
        case 'friended':
            $f_status="Friended!";
            $f_button="Remove Friendship?";
            $disabled = '';
            break;
    }
}
?>

<div class="container">
    <div class="row">
        
        <div class="col-12 col-sm-8" style="border-right: 1px solid #e8e8e8;">
            <br>
            <?php 
                if($logged_in and $status == 'friended'){
                    ?>
                    <h2>
                        Uploads Shared With Me:
                    </h2><br>
                   <?php
                    display_files(array('sharetype'=>'friends', 'recs_per_page'=>3, 'user'=>$_SESSION['userid'], 'owned_by_friend'=>$user));
                }
            ?>
            <br><br>
            <h2>
                Public Uploads:
            </h2><br>
            
            <?php 
                display_files(array('sharetype'=>'public', 'recs_per_page'=>($logged_in and $status == 'friended') ? 3 : 6, 'user'=>$user, 'mine'=>TRUE));
            ?>
            
        </div>
<!--        switch to choose whether browsing through your uploaded files, public, friends-->
        <div class="col-12 col-sm-4">
            <br>
            <h2><?php echo $f_name; ?>'s Profile</h2>
            <hr>
            <?php
            $pic = glob ("./profile-pics/" . $user . ".*");
            $pic = $pic ? $pic[0] : "./images/blankprofile.png";
            echo '<img class="profilepic" src="'. $pic .'" alt="profile picture">';
            ?>
            <br>
            <hr>
            <br>
            <ul class="list-group">
              <li class="list-group-item"> <?php echo $f_name; ?> </li>
              <?php if($logged_in){ ?>
                  <li class="list-group-item"><a class="text-dark d-flex justify-content-between align-items-center" data-toggle="tab" href="#friendStatus"><?php echo $f_status; ?></a></li>
              <?php } ?>
            </ul>

            <div class="tab-content border-0">
              <div id="friendStatus" class="tab-pane fade">
                <form action=".\scripts\<?php echo $status=='friended' ? 'endFriend.php':'createFriend.php'?>" method="post">
                    <input type="hidden" name="friendid" value="<?php echo $user; ?>">
                    <button type="submit" class="btn <?php echo ($status=='friended') ? 'btn-danger' : 'btn-primary' ?>" <?php echo $disabled; ?>><?php echo $f_button; ?></button>
                </form>
              </div>
            </div>
        </div>
        
    </div>
</div>

<?php
include("footer.php");
?>