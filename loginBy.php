<?php
// Check if a user is logged in
if (isset($_SESSION['username'])) {
    // If logged in as a regular user, set a welcome message with the username
    $welcome_message = "Welcome user, " . $_SESSION['username'] . "!";
} else {
    // If not logged in, set a generic welcome message for guests
    $welcome_message = "Welcome guest";
}

// Check if an admin is logged in
if (isset($_SESSION['admin_id'])) {
    // If logged in as an admin, set a welcome message with the admin ID
    $welcome_message = "Welcome admin, " . $_SESSION['admin_id'] . "!";
}

// Check if a flag indicating the creation of an auction is set in the session
$createdAuction = isset($_SESSION['created_auction']) ? $_SESSION['created_auction'] : null;
// Unset the flag to clear it from the session
unset($_SESSION['created_auction']);
?>
