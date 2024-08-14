<?php
    // Include the file containing the database connection
    include 'dbconnection.php';
    // Include header and navigation bar
    include 'header.php';
    include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include CSS files -->
    <link rel="stylesheet" href="./styles/login.css">
    <link rel="stylesheet" href="./styles/carbuy.css">
</head>
<body>

    <!-- Display a banner -->
    <img src="banners/1.jpg" alt="Banner" />

    <!-- Login form container -->
    <div class="login-container">
        <form id="loginForm" class="login-form" action="login-handler.php" method="post">
            <!-- Input fields for username and password -->
            <label for="loginUsername">Username:</label>
            <input type="text" id="loginUsername" name="loginUsername" required>

            <label for="loginPassword">Password:</label>
            <input type="password" id="loginPassword" name="loginPassword" required>

            <!-- Submit button for the login form -->
            <button type="submit">Login</button>
            <!-- Link to register page for new users -->
            <div class="register-link">
                Don't have an account? <a href="register.php">Register</a>
            </div>
        </form>
    </div>

</body>
</html>
