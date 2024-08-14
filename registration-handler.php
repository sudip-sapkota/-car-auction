<?php
// Start the session to manage user session data
session_start();

// Include the file containing the database connection
require 'dbconnection.php';

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data from POST request
    $email = $_POST["email"];
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $confPassword = $_POST["confPassword"];

    // Check if the entered passwords match
    if ($password === $confPassword) {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert user data into the database
        $sql = "INSERT INTO users (email, Username, Password) VALUES (:email, :Username, :Password)";
        $stmt = $connection->prepare($sql);

        // Check if the statement is prepared successfully
        if ($stmt) {
            // Bind parameters to the prepared statement
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":Username", $username);
            $stmt->bindParam(":Password", $hashedPassword);

            // Execute the prepared statement
            if ($stmt->execute()) {
                // If registration is successful, display a success message
                echo 'User registration successful! Welcome, ' . $username . '! <br/>';
                // Redirect the user to the login page
                echo "<script>window.location.href = 'login.php';</script>";
                // Prompt the user to log in after successful registration
                echo 'Get back to the login page and login.';
            } else {
                // If an error occurs while executing the statement, display an error message
                echo 'Error inserting data.';
            }
            // Close the cursor to free up resources
            $stmt->closeCursor();
        } else {
            // If an error occurs while preparing the statement, display an error message
            echo 'Error preparing statement.';
        }
    } else {
        // If passwords do not match, display an error message
        echo "Password confirmation failed. Please make sure your passwords match.";
    }
}
?>
