<?php
include("header.php");

if(!$logged_in){
    header("Location: login.php");
    exit();
}
include("./scripts/displayFiles.php");
?>

<div class="container">
    <div class="row">
        
        <div class="col-12 col-sm-8" style="border-right: 1px solid #e8e8e8;">
          
           <h1>
               Welcome, <?php echo $_SESSION['username']; ?>!
           </h1>
           <br>
           <h2 id='friends-display'>
                My Uploads For Friends:
            </h2>
            <?php 
                display_files(array('sharetype'=>'friends', 'recs_per_page'=>3, 'user'=>$_SESSION['userid'], 'mine'=>TRUE));
            ?>
            <br><br>
            <h2 id='public-display'>
                My Public Uploads:
            </h2>
            <?php 
                display_files(array('sharetype'=>'public', 'recs_per_page'=>3, 'user'=>$_SESSION['userid'], 'mine'=>TRUE));
            ?>
            <br><br>
            <h2 id='private-display'>
                My Private Uploads:
            </h2>
            <?php 
                display_files(array('sharetype'=>'private', 'recs_per_page'=>3, 'user'=>$_SESSION['userid'], 'mine'=>TRUE));
            ?>
            
        </div>
<!--        switch to choose whether browsing through your uploaded files, public, friends-->
        <div class="col-12 col-sm-4">
            <br>
            <h2>My Profile</h2>
            <hr>
            <?php
            $pic = glob ("./profile-pics/" . $_SESSION['userid'] . ".*");
            $pic = $pic ? $pic[0] : "./images/blankprofile.png";
            echo '<img class="profilepic" src="'. $pic .'" alt="profile picture">';
            ?>
            <br>
            <hr>
            <br>
            <ul class="list-group">
              <li class="list-group-item"><a class="text-dark" data-toggle="tab" href="#changeUser">
                  Change Username
              </a></li>
              <li class="list-group-item"><a class="text-dark" data-toggle="tab" href="#changeProfile">Change Profile Picture</a></li>
            </ul>

            <div class="tab-content border-0">
              <div id="changeUser" class="tab-pane fade">
                <form action=".\scripts\changeUsername.php" method="post">
                    <div class="form-group">
                        <input type="text" name='newUsername' class="form-control" id="inputUsername" placeholder="Change Username" required>
                    </div>
                  <input type="hidden" name="submitted" value="True">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
              <div id="changeProfile" class="tab-pane fade">
                <form action=".\scripts\changeProfile.php" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label for="profileForm">New Picture</label>
                        <input type="file" class="form-control-file" id="profileForm" name='profileFile' required>
                      </div>
                    <input type="hidden" name="submitted" value="True">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
            <br>
            <div align=center>
                <a class="btn btn-success btn-lg" href="upload.php" role="button">UPLOAD</a>
            </div>
            <br>
            <hr>
            <br><br>
            <div class="container">
                <h2>Friend List</h2>
                <div class="list-group" id="friend-list-display">
                    <?php 
                    $run = mysqli_query($con, "SELECT id_2, status FROM friends WHERE id_1=".$_SESSION['userid']);
                    while($result = mysqli_fetch_assoc($run)){
                        $friend_id = $result['id_2'];
                        switch($result['status']){
                            case 'friended':
                                $status = 'Friend';
                                break;
                            case 'sent':
                                $status = 'Request Sent';
                                break;
                            case 'received':
                                $status = 'Request Received!';
                        }
                        if($friend_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT username FROM users WHERE userid=$friend_id"))){
                            ?>
                            <a href='<?php echo "profile.php?user=$friend_id" ?>' class="list-group-item d-flex justify-content-between align-items-center"><?php echo $friend_info['username'] ?><span class="badge badge-primary badge-pill"><?php echo $status ?></span></a>
                        <?php    
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php
include("footer.php");
?>