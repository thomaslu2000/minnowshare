<?php
// Initialize a session.
session_start();
require_once("includes/connection.php");
include_once("includes/functions.php");
function back($m){
        close_connection_and_leave("login.php", $m);
        exit();
    }
?>
<?php
if (isset($_POST['submitted'])) { // Check if the form has been submitted.
    if (preg_match ('%^[A-Za-z0-9]\S{3,20}$%', stripslashes(trim($_POST['username'])))) {
        $u = escape_data($_POST['username']);
    } else {
        $u = FALSE;
        back("Please enter a valid Username!");
    }
    
    if (preg_match ('%^[A-Za-z0-9]\S{4,20}$%', stripslashes(trim($_POST['pass'])))) {
        $p = escape_data($_POST['pass']);
    } else {
        $p = FALSE;
        echo back("Please enter a valid password!");
    }
    
    if ($u && $p) {
        $p = hash("sha256", $p);
        $query = "SELECT userid FROM users WHERE username='$u' AND pass='$p'";
        $result = mysqli_query($con, $query) or trigger_error("Userid or Password incorrect");
        if (mysqli_affected_rows($con) == 1) { // A match was made.
            $row = mysqli_fetch_array ($result, MYSQLI_ASSOC);
            mysqli_free_result($result);
            setUser($row['userid'], $u);
            header("Location: myprofile.php");
            close_connection();
            exit();
        }
        else { // No match was made.
            back("Username or Password incorrect");
            close_connection(); // Close the database connection
            exit();
        }       
    back("Username or Password incorrect");
    }
}

?>


<?php include("header.php"); ?>

<fieldset align=center style="width: calc(200px + 20vw); margin:auto;">
   <div class="jumbotron" align=center>
    <h1>Log In</h1>
    </div>
    <form action="login.php" method="post">
    <div class="form-group">
        <label for="inputUsername">Username</label>
        <input type="text" name='username' class="form-control" id="inputUsername" placeholder="Enter Username" required>
        <small id="userHelp" class="form-text text-muted">Usernames must be alphanumeric between 5 and 20 characters</small>
    </div>
    <div class="form-group">
       <label for="inputPassword">Password</label>
       <input type="password" name='pass' class="form-control" id="inputPassword" placeholder="Enter Password" required>
       <small id="userHelp" class="form-text text-muted">Passwords must be alphanumeric between 5 and 20 characters</small>
     </div>
      <input type="hidden" name="submitted" value="True">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</fieldset>

<?php include("footer.php"); ?>