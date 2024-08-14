<?php
// Start the session to manage user session data
session_start();

// Include the file containing the database connection
include('dbconnection.php');

// Include header and navigation bar
include 'header.php';
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include CSS files for styling -->
    <link rel="stylesheet" href="styles/admin_user_register.css"> <!-- Specific styling for the registration form -->
    <link rel="stylesheet" href="styles/carbuy.css"> <!-- General styling for the website -->
    <link rel="stylesheet" href="styles/login.css"> <!-- Styling for login-related elements -->
</head>
<body>
    <!-- Display a banner -->
    <img src="banners/1.jpg" alt="Banner" />

    <div class="container">
        <div class="form-box">
            <!-- Registration form -->
            <form id="registerForm" action="registration-handler.php" method="post" onsubmit="return validateRegisterForm()">
                <!-- Input field for email/phone -->
                <label for="email">Email or Phone:</label>
                <input type="text" id="email" name="email" required>

                <!-- Input field for username -->
                <label for="registerUsername">Username:</label>
                <input type="text" id="registerUsername" name="Username" required>

                <!-- Input field for password -->
                <label for="registerPassword">Password:</label>
                <input type="password" id="registerPassword" name="Password" required>

                <!-- Input field to confirm password -->
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confPassword" required>
                
                <!-- Span element to display password match error message -->
                <span id="passwordMatchError" class="error-message"></span>

                <!-- Container for buttons -->
                <div class="buttons-container">
                    <!-- Button to submit registration form -->
                    <div>
                        <button type="submit" name="submit">Register</button>
                    </div>
                    <!-- Button to navigate to login page -->
                    <div>
                        <a href="login.php"><button type="button">Login</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
