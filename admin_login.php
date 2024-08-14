<?php
session_start();
include('dbconnection.php');
include 'header.php';
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- <link rel="stylesheet" href="styles/admin_register.css">  -->
    <link rel="stylesheet" href="styles/carbuy.css"> 
    <link rel="stylesheet" href="styles/login.css"> 
</head>
<body>
  <!-- Display a banner -->
  <img src="banners/1.jpg" alt="Banner" />

<div class="login-container">
    <form id="loginForm" class="login-form" action="admin_login_handler.php" method="post">
        <label for="loginUsername">Username:</label>
        <input type="text" id="loginUsername" name="loginUsername" required>

        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="loginPassword" required>

        <button type="submit">Login</button>
        <div class="register-link">
            Don't have an account? <a href="admin_register.php">Register</a>
        </div>
    </form>
</div>

</body>
</html>
