<?php
// Start the session
session_start();

// Unset specific session variables
unset($_SESSION['name']); // Unset 'name' session variable
unset($_SESSION['user_id']); // Unset 'user_id' session variable
unset($_SESSION['admin_id']); // Unset 'admin_id' session variable
unset($_SESSION['username']); // Unset 'username' session variable

// Destroy the session
session_destroy();

// Redirect the user to the index.php page after logout
echo '<script type="text/javascript">';
echo 'window.location.href = "index.php";'; // Redirect to index.php
echo '</script>';
?>
