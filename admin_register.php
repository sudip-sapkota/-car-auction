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
    <link rel="stylesheet" href="styles/admin_user_register.css"> 
    <link rel="stylesheet" href="styles/carbuy.css"> 
    <link rel="stylesheet" href="styles/login.css"> 
</head>
<body>
  <!-- Display a banner -->
  <img src="banners/1.jpg" alt="Banner" />



<div class="container">
    <div class="form-box">
        <form id="registerForm" action="admin_registration-handler.php" method="post" onsubmit="return validateRegisterForm()">
            <label for="email">Email or Phone:</label>
            <input type="text" id="email" name="email" required>

            <label for="registerUsername">Username:</label>
            <input type="text" id="registerUsername" name="Username" required>

            <label for="registerPassword">Password:</label>
            <input type="password" id="registerPassword" name="Password" required>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confPassword" required>
            <span id="passwordMatchError" class="error-message"></span>

            <!-- Buttons Container -->
            <div class="buttons-container">
                <!-- First Line of Buttons -->
                <div>
                    <button type="submit" name="submit">Register</button>
                </div>
                <!-- Second Line of Buttons -->
                <div>
                    <a href="admin_login.php"><button type="button">Login</button></a>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
