<?php
// Start session to enable session variables
session_start();

// Include necessary files
include 'dbconnection.php'; // Include file for database connection
include 'header.php'; // Include file for header content
include 'loginBy.php'; // Include file for login functionality
include 'nav.php'; // Include file for navigation menu

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Check if the auction ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // If auction ID is not provided, redirect to home page or display an error message
    echo '<script type="text/javascript">';
    echo 'window.location.href = "userAuction.php";'; // Redirect to userAuction.php
    echo '</script>';
    exit();
}

// Retrieve auction ID from URL parameter
$auction_id = $_GET['id'];

// Process delete request
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    // Check if there are associated bids
    $check_bid_stmt = $connection->prepare("SELECT COUNT(*) FROM bid WHERE auction_id = :auction_id");
    $check_bid_stmt->bindParam(':auction_id', $auction_id);
    $check_bid_stmt->execute();
    $bid_count = $check_bid_stmt->fetchColumn();

    // Check if there are associated reviews
    $check_review_stmt = $connection->prepare("SELECT COUNT(*) FROM review WHERE auction_id = :auction_id");
    $check_review_stmt->bindParam(':auction_id', $auction_id);
    $check_review_stmt->execute();
    $review_count = $check_review_stmt->fetchColumn();

  

    // Redirect to userAuction.php with success message
    echo '<script type="text/javascript">';
    echo 'alert("Auction deleted successfully.");'; // Display alert message
    echo 'window.location.href = "userAuction.php";'; // Redirect to userAuction.php
    echo '</script>';
    exit();
}

// Fetch the auction details from the database
$stmt = $connection->prepare("SELECT * FROM auction WHERE auction_id = :auction_id");
$stmt->bindParam(':auction_id', $auction_id);
$stmt->execute();
$auction = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the auction exists
if (!$auction) {
    // If auction does not exist, redirect to home page or display an error message
    header("Location: userAuction.php");
    exit();
}

// Process form submission to update the auction
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $categoryId = $_POST['categoryId'];
    $endDate = $_POST['endDate'];
    $startingBid = $_POST['startingBid'];
    // Add more fields as needed

    // Update the auction in the database
    $update_stmt = $connection->prepare("UPDATE auction SET title = :title, description = :description, categoryId = :categoryId, endDate = :endDate, startingBid = :startingBid WHERE auction_id = :auction_id");
    $update_stmt->bindParam(':title', $title);
    $update_stmt->bindParam(':description', $description);
    $update_stmt->bindParam(':categoryId', $categoryId);
    $update_stmt->bindParam(':endDate', $endDate);
    $update_stmt->bindParam(':startingBid', $startingBid);
    $update_stmt->bindParam(':auction_id', $auction_id);
    $update_stmt->execute();

    // Redirect to the updated auction page or any other appropriate page
    echo '<script type="text/javascript">';
    echo 'window.location.href = "userAuction.php";'; // Redirect to userAuction.php
    echo '</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Auction</title>
    <!-- Add your CSS styles here -->
    <link rel="stylesheet" href="./styles/add_edit_Auction.css">
    <link rel="stylesheet" href="./styles/carbuy.css">
    <link rel="stylesheet" href="./styles/login.css">
</head>
<body>
    <img src="banners/1.jpg" alt="Banner" />
    <div class="container">
        <h1>Edit Auction</h1>
        <form action="#" method="post">
            <!-- Hidden input field for auction_id -->
            <input type="hidden" name="auction_id" value="<?php echo htmlspecialchars($auction['auction_id'] ?? ''); ?>">
            
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($auction['title'] ?? ''); ?>">
            
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo htmlspecialchars($auction['description'] ?? ''); ?></textarea>
            
            <label for="categoryId">Category:</label>
            <input type="text" id="categoryId" name="categoryId" value="<?php echo htmlspecialchars($auction['categoryId'] ?? ''); ?>">
            
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" value="<?php echo htmlspecialchars($auction['endDate'] ?? ''); ?>">
            
            <label for="startingBid">Starting Bid:</label>
            <input type="text" id="startingBid" name="startingBid" value="<?php echo htmlspecialchars($auction['startingBid'] ?? ''); ?>">
            
            <!-- Add photoPath field if needed -->
            
            <input type="submit" value="Update Auction">
        </form>

      
    </div>
</body>
</html>
