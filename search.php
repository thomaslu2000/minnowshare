<?php
include("header.php");
require_once("./includes/functions.php"); //file MUST be included from a page in parent directory
require_once("./includes/connection.php");

$search = escape_data($_GET['q']);
$file_type = $_GET['file_type'];
$search_type = $_GET['search_type']; ?>
<div class="container" style="padding: 30px 40px 0 40px">
    <?php
    if($search_type == 'files'){
        if(!$logged_in and $file_type != 'public'){
            ?>
            
            <div align=center class="container">
               <hr>
               <br>
                <h2>
                    Must Be Logged In To Search Non-Public Files!
                </h2>
            </div>
            
            <?php
            include("footer.php");
            exit();
        }
        include("scripts/displayFiles.php");
        switch($file_type){
            case 'public':
                echo "<br><h2 id='public-display'>Public Uploads: </h2><br>";
                display_files(array('sharetype'=>'public', 'recs_per_page'=>6, 'like'=>$search));
                break;
            case 'private':
                echo "<br><h2 id='private-display'>My Private Uploads: </h2><br>";
                display_files(array('sharetype'=>'private', 'recs_per_page'=>6, 'user'=>$_SESSION['userid'], 'like'=>$search));
                break;
            case 'friends':
                echo "<br><h2 id='friends-display'>Uploads From Friends: </h2><br>";
                display_files(array('sharetype'=>'friends', 'recs_per_page'=>6, 'user'=>$_SESSION['userid'], 'like'=>$search));
                break;
        }

    } else{
        $name_query = mysqli_query($con, "SELECT userid, username FROM users WHERE username LIKE '%$search%'"); ?>

        <div class="container">
           <div class="container" align=center>
               <h1>Users</h1>
           </div>
            <table class="table table-striped">
              <tbody>
        <?php
        while($user_info = mysqli_fetch_assoc($name_query)){
            $uid = $user_info['userid'];
            $username = $user_info['username'];
            $pic = glob ("./profile-pics/" . $uid . ".*");
            $pic = $pic ? $pic[0] : "./images/blankprofile.png";
    ?>
                <tr>
                  <td style="width: calc(10vw + 50px)"><img style="width: 70%" src="<?php echo $pic ?>" alt="<?php echo $username; ?>'s Profile Pic"></td>
                  <td><a href="profile.php?user=<?php echo $uid;?>"><h2><?php echo $username ?></h2></a></td>
                </tr>

        <?php
            }?>
                </tbody>
            </table>     
        </div>
    <?php 
    } ?>
</div>
<?php 
include("footer.php");
?>