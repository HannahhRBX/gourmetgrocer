<?php
$loggedOut = true;
// Start the session to maintain user state
// Clear all session variables
session_unset(); 
$title = 'Login Page'; require __DIR__ . "/inc/header.php";
     
require __DIR__ . "/components/login-form.php";
?>

<style>
body {
    background-image: url('/images/BackgroundImage.jpg');
    background-color: #ffffff;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>