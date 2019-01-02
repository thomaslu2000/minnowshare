<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}

if(isset($_POST['submitted'])){
    require("../includes/connection.php");
    require("../includes/functions.php");

    function back($m){
        close_connection_and_leave("../register.php", $m);
        exit();
    }
    // Make sure the submitted registration values are not empty.
    if (!isset($_POST['username'], $_POST['password'], $_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        // One or more values are empty...
        back('Please complete the registration form!');
    }
    if (preg_match ('%^[A-Za-z0-9]\S{4,20}$%', stripslashes(trim($_POST['username'])))) {
        $u = escape_data($_POST['username']);
    } else {
        $u = FALSE;
        back('Usernames must be alphanumeric between 5 and 20 characters!');
    }

    if (preg_match ('%^[A-Za-z0-9]\S{4,20}$%', stripslashes(trim($_POST['password'])))) {
        $p = escape_data($_POST['password']);
    } else {
        $p = FALSE;
        back('Passwords must be alphanumeric between 5 and 20 characters!');
    }
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $e = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

    } else {
        $e = FALSE;
        back('Please enter a valid email!');
    }
    // We need to check if the account with that username exists
    if (mysqli_query($con, "SELECT userid FROM users WHERE username = '$u'")) {
        // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
        // Store the result so we can check if the account exists in the database.
        if (mysqli_affected_rows($con) > 0) {
            // Username already exists
            back('Username exists, please choose another!');
        } else {
            $p = hash("sha256", $p);
            // Username doesnt exists, insert new account
            if (mysqli_query($con, "INSERT INTO users (userid, username, pass, email) VALUES (NULL, '$u', '$p', '$e')")) {
                setUser(mysqli_insert_id($con), $u);

                close_connection_and_leave("../myprofile.php", "You have successfully registered with username '$u' and email '$e'!");
                exit();

            } else {
                back('Could not prepare statement!');
            }
        }
    } else {
        back('Could not create account');
    }
}
?>