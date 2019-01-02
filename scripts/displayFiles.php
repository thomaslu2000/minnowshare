<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("./includes/functions.php"); //file MUST be included from a page in parent directory
require_once("./includes/connection.php"); 
function back($m){
    close_connection_and_leave($_SERVER['PHP_SELF'], $m);
    exit();
}

function get_end_query($table, $index, $prev_or_next, $num_rows, $extra_cond){
  $q = "SELECT item_id FROM $table WHERE";
  
  if($extra_cond){
      $q .= $extra_cond;
    }
  
  if ($index == 0) return $q . " TRUE ORDER BY item_id DESC LIMIT $num_rows";
  if ($prev_or_next == 'prev') return $q . " item_id>$index ORDER BY item_id ASC LIMIT $num_rows";
  return $q . " item_id<$index ORDER BY item_id DESC LIMIT $num_rows";
}

function display_files($args){ // assoc array for args
    //include checks for login
    global $con;
    $sharetype = $args['sharetype'];
    $recs_per_page = $args['recs_per_page'];
    if(isset($args['user'])) $user = $args['user'];
    $friend = isset($args['owned_by_friend']) ? $args['owned_by_friend'] : FALSE;
    $mine = isset($args['mine']);
    $like = isset($args['like']) ? $args['like'] : FALSE;
    
    $table = $sharetype."_uploads";
    if($mine or $sharetype == 'private'){
        $extra_cond = " owner_id=$user AND";
    } elseif($sharetype == 'friends'){
        $table = "access_files";
        $extra_cond = " user=$user AND";
        if($friend) $extra_cond .= " owner_id=$friend AND";
    } else{
        $extra_cond = '';
    }
    if ($like) $extra_cond .= " title LIKE '%$like%' AND";
    
    
    $last_ind = isset($_SESSION['last_ind_'.$sharetype]) ? $_SESSION['last_ind_'.$sharetype] : 0; //negative if backwards

    $query = get_end_query($table, abs($last_ind), ($last_ind<0) ? 'prev' : 'next', $recs_per_page, $extra_cond);

    if (! $run = mysqli_query($con, $query)){
        echo 'query failed '.$query;
        exit();
    }

    if($res = mysqli_fetch_assoc($run)){
        echo "<div class='container'>
        <div class='row'>";
        $first = $res['item_id'];
        do {
            $current = $res['item_id'];
            if (! $result = mysqli_fetch_assoc(mysqli_query($con, "SELECT owner_id, title, short, file_name FROM ".$sharetype."_uploads WHERE item_id=$current"))){
                continue;
            }
            $filename = $result['file_name'];
            $file_info = pathinfo($filename);
            $owner_id = $result['owner_id'];
            $path_to_file = "./uploads/" . $sharetype . "/" . $owner_id . "/";

            $img = $path_to_file . $file_info['filename'] . '^@&$' . ".*";
            $img = glob($img);
            $file_type = get_file_type($filename);
            if($img){
                $img = $img[0];
            } else{
                if ($file_type == 'image') $img = $path_to_file . $filename;
                else $img = "images/".$file_type.'.jpg';
            }
                ?>
                
                <div class="col-12 col-sm-6 col-md-4">
                   <a href='file.php?<?php echo "share=$sharetype&file=$current" ?>'>
                        <div class="card mb-4" align=center> 
                            <img class="card-img-top" src="<?php echo $img ?>" alt="<?php echo $result['title'];?>">
                            <hr>
                            <?php if($owner_run = mysqli_query($con, "SELECT username FROM users WHERE userid=$owner_id") and $owner_result=mysqli_fetch_assoc($owner_run)){?>
                                <div class="card-header"> 
                                    <a class="text-dark" href="profile.php?user=<?php echo $owner_id;?>">
                                        <small>by <?php echo $owner_result['username'];?></small>
                                    </a>
                                </div>
                            <?php } ?>
                            <a class="no-color" href='file.php?<?php echo "share=$sharetype&file=$current" ?>'>
                                <div class="card-body">
                                     <h4 class="card-title"><?php echo $result['title'];?></h4>
                                     <?php if($result['short'] != "NULL"){ ?>
                                          <p class="card-text"><?php echo $result['short']; ?></p>
                                    <?php } ?>

                                </div>
                            </a>
                            <div class="card-footer">
                                <small>File Type: <?php echo $file_type;?></small>
                            </div>
                          </div>
                    </a>
                  </div>

    <?php 
        } while ($res = mysqli_fetch_assoc($run));

        
        echo '</div>';
        $my_page = $_SERVER['REQUEST_URI'];
        if(isset($_GET['p'])){
            $get = $_GET;
            unset($get['last_ind_public']);
            unset($get['last_ind_private']);
            unset($get['last_ind_friends']);
            unset($get['p']);
            $my_page = $_SERVER['PHP_SELF'] . '?' . http_build_query($get);
        }
//        global $view, $user;
//        if($view and $view != 'none') $my_page = add_get_var($my_page, "view=$view");
//        if($user) $my_page = add_get_var($my_page, "user=$user");
        $prev_idx = max($first, $current);
        $next_idx = min($first, $current);

        $prev_query = get_end_query($table, $prev_idx, 'prev', 1, $extra_cond);
        $next_query = get_end_query($table, $next_idx, 'next', 1, $extra_cond);


        //prev
        $prev_class = ' disabled';
        if ($run = mysqli_query($con, $prev_query) and mysqli_fetch_assoc($run)){ // Must use 'and' because of lower precedence than '&&'
            $prev_class = "";
        }

        //next
        $next_class = ' disabled';
        if ($run = mysqli_query($con, $next_query) and mysqli_fetch_assoc($run)){ // Must use 'and' because of lower precedence than '&&'
            $next_class = "";
        }
        ?>
        <nav>
          <ul class="pagination" style="font-size: 1.5em; float: right;">
            <li class="page-item<?php echo $prev_class; ?>">
              <a class="page-link" href="<?php echo add_get_var($my_page, 'last_ind_' . $sharetype . '=' . -$prev_idx.'&p=True') . "#$sharetype-display"; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item<?php echo $next_class; ?>">
              <a class="page-link" href="<?php echo add_get_var($my_page, 'last_ind_' . $sharetype . '=' . $next_idx.'&p=True') . "#$sharetype-display"; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>

    <?php 
        echo  "</div>";
        } else{
            echo '<h3> No Files Yet! </h3>';
        }
}
?>