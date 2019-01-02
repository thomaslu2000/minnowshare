
<?php

//    close_connection();
include("header.php");
?>

<fieldset align=center style="width: calc(200px + 20vw); margin:auto;">
   <div class="jumbotron" align=center>
        <h1>Register</h1>
    </div>
    <form action="scripts/registerAccount.php" method="post">
    <div class="form-group">
        <label for="inputUsername">Username</label>
        <input type="text" name='username' class="form-control" id="inputUsername" placeholder="Enter Username" required>
        <small id="userHelp" class="form-text text-muted">Usernames must be alphanumeric between 5 and 20 characters</small>
    </div>
    <div class="form-group">
       <label for="inputPassword">Password</label>
       <input type="password" name='password' class="form-control" id="inputPassword" placeholder="Enter Password" required>
       <small id="userHelp" class="form-text text-muted">Passwords must be alphanumeric between 5 and 20 characters</small>
     </div>
     <div class="form-group">
       <label for="inputEmail">Email address</label>
       <input type="email" name='email' class="form-control" id="inputEmail" placeholder="Enter email" required>
     </div>
      <input type="hidden" name="submitted" value="True">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</fieldset>
		
<?php
include("footer.php");
?>