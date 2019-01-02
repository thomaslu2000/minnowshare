<?php 
include("header.php");
if(!isset($_GET['file'], $_GET['share']) or !is_numeric($_GET['file'])){
    header("Location: browse.php");
    exit();
}

$file_id = $_GET['file'];
switch($_GET['share']){
    case 'public': case 'friends': case 'private':
        $sharetype = $_GET['share'];
        break;
    default:
        $sharetype = 'public';
}
include_once("./includes/functions.php");
function back($m){
    close_connection_and_leave("browse.php", $m);
    exit();
}


if($sharetype != 'public' and !$logged_in) back("Not Logged In!");
if(isset($_SESSION['userid'])) $u = $_SESSION['userid'];
require("./includes/connection.php");

$table = $sharetype . "_uploads";
$query = "SELECT owner_id, title, short, description, file_name FROM $table WHERE item_id=$file_id";
$file_data = mysqli_query($con, $query);
if(mysqli_affected_rows($con)!=1){
    back('File Not Found');
}
$file_data = mysqli_fetch_assoc($file_data);

$filename = $file_data['file_name'];
$file_type = get_file_type($filename);
$file_info = pathinfo($filename);
$owner_id = $file_data['owner_id'];
$is_owner = $logged_in && $owner_id == $u;
$description = $file_data['description']=="NULL" ? 'No Description Provided' : $file_data['description'];

//Permissions
if($sharetype == 'friends' and !$is_owner){
    $query = "SELECT null FROM access_files WHERE user=$u AND item_id=$file_id";
    mysqli_query($con, $query);
    if(mysqli_affected_rows($con)==0){
        back("Please Ask For Permission To Access File");
    }
} elseif($sharetype == 'private' and !$is_owner){
    back("This File is Private");
}

if(! $owner_name = mysqli_query($con, "SELECT username FROM users WHERE userid=$owner_id")) back("Owner not Found");
$owner_name = mysqli_fetch_assoc($owner_name)['username'];

$path_to_file = "./uploads/$sharetype/$owner_id/";

$img = $path_to_file . $file_info['filename'] . '^@&$' . ".*";
$img = glob($img);
if($img){
    $img = $img[0];
} elseif ($file_type == 'image') {
    $img = $path_to_file . $filename;
} else {$img = "./images/".$file_type.'.jpg';
}

//delete needs names share and file

?>
<div class="container" align=center>
   <a href="<?php echo $img ?>">
        <img class="filepic" src="<?php echo $img ?>" alt="<?php echo $file_data['title'];?>">
    </a>
    <hr>
    
    <form action="scripts/download.php" method="post">
       <input type="hidden" name="file_loc" value="<?php echo $path_to_file . $filename; ?>">
       <input type="hidden" name="filename" value="<?php echo $filename; ?>">
        <button type="submit" class="btn btn-success">Download</button>
    </form>
    
    <hr>
    <?php if($is_owner){?>
                  <form action=".\scripts\deleteFile.php" method="post">
                        <input type="hidden"  name="share" value="<?php echo $sharetype ?>">
                        <input type="hidden"  name="file" value="<?php echo $file_id ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  <hr>
            <?php } ?>
    
    <div class="container">
        <table class="table table-striped table-hover" id="fileInfo">
          <thead class="thead-dark">
            <tr>
              <th colspan="4">File Data</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Title:</th>
              <td colspan="3"><?php echo $file_data['title']; ?></td>
            </tr>
            <tr>
              <th scope="row">Extension:</th>
              <td><?php echo ".".$file_info['extension']; ?></td>
              <th scope="row">Type:</th>
              <td><?php echo $file_type; ?></td> 
            </tr>
            <tr>
              <th scope="row">Owner:</th>
              <td colspan="3"><a href="profile.php?user=<?php echo $owner_id; ?>"><?php echo $owner_name; ?></a></td>
            </tr>
            <tr>
            <th scope="row">Description:</th>
              <td colspan="3"><?php echo $description; ?></td>
            </tr>
          </tbody>
        </table>
        
<!--        Share if owner-->
        <?php if($is_owner and $sharetype=='friends'){?>
                 <hr>
                 <h3 id="access">Manage Access To File</h3>
                  <div class="container">
                    <h2>Friend List</h2>
                    <div class="container" style="padding: 0 10% 0 10%;">
                       
                        <ul class="list-group" id="friend-list-display">
                            <?php 
                            $run = mysqli_query($con, "SELECT id_2 FROM friends WHERE status='friended' AND id_1=".$_SESSION['userid']);
    
                            while($result = mysqli_fetch_assoc($run)){
                                $friend_id = $result['id_2'];
                                if($friend_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT username FROM users WHERE userid=$friend_id"))){
                                    
                                    mysqli_query($con, "SELECT user FROM access_files WHERE user=$friend_id AND item_id=$file_id");
                                    $access_status = mysqli_affected_rows($con);
                                    ?>
                                    
                                    <li class="list-group-item d-flex justify-content-between align-items-center"> <?php echo $friend_info['username']; ?>
                                        <form method="post" action="scripts/togglePermission.php">
                                           <input type="hidden" name="item_id" value="<?php echo $file_id; ?>">
                                           <input type="hidden" name="item_title" value="<?php echo $file_data['title']; ?>">
                                           <input type="hidden" name="user_id" value="<?php echo $friend_id; ?>">
                                           <input type="hidden" name="owner_id" value="<?php echo $u; ?>">
                                           <input type="hidden" name="has_access" value="<?php echo $access_status; ?>">
                                           <input type="hidden" name="url" value="<?php 
                                                $get = $_GET;
                                                unset($get['message']);
                                                echo $_SERVER['PHP_SELF'] . '?' . http_build_query($get);?>">
                                            <button type="submit" class="btn <?php echo $access_status ? 'btn-success' : 'btn-danger'; ?>">
                                                <?php 
                                                    if($access_status){
                                                        echo 'Has Access'; 
                                                    } else{
                                                        echo 'No Access'; 
                                                    }?>
                                            </button>
                                        </form>
                                    </li>
                                    
                                <?php    
                                }
                            }
                        ?>
                        </ul>
                        
                    </div>
                </div>
            <?php } ?>
   </div>
    
</div>
<?php include("footer.php"); ?>