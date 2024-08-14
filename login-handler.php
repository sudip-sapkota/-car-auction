<?php
// Start the session to manage user session data
session_start();

// Include the file containing the database connection
include 'dbconnection.php';

// Check if the request method is POST (i.e., form submission)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the POST data
    $username = $_POST["loginUsername"];
    $password = $_POST["loginPassword"];

    // Prepare a query to fetch user data based on the provided username
    $query = $connection->prepare('SELECT * FROM users WHERE username = :username');
    $query->execute(['username' => $username]);

    // Fetch the user data associated with the provided username
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Verify if the user exists and the provided password matches the hashed password in the database
    if ($user && password_verify($password, $user['password'])) {
        // If the username and password are correct, set session variables
        $_SESSION['username'] = $user['username']; // Store the username in the session
        $_SESSION['user'] = $user['user_id']; // Store the user ID in the session
        // Redirect the user to userAuction.php after successful login
        echo "Login successful! Welcome back, " . $user['username'] . "!";
        echo "<script>window.location.href = 'userAuction.php';</script>";
        exit(); // Terminate script execution
    } else {
        // If the username or password is incorrect, display an error message
        echo "Invalid username or password. Please try again.";
    }
}
?>
