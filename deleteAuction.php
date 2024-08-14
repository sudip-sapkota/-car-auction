<?php
session_start();
include 'dbconnection.php';

// Check if auction ID is set
if (isset($_GET['id'])) {
    $auction_id = $_GET['id'];
}

// Check if form is submitted and auction ID is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['auction_id'])) {
    $auction_id = $_POST['auction_id'];

    // Start a transaction to ensure data consistency
    $connection->beginTransaction();

    try {
        // Delete bids associated with the auction
        $deleteBidsQuery = $connection->prepare('DELETE FROM bid WHERE auction_id = :auction_id');
        $deleteBidsQuery->bindParam(':auction_id', $auction_id, PDO::PARAM_INT);
        $deleteBidsQuery->execute();

        // Delete reviews associated with the auction
        $deleteReviewsQuery = $connection->prepare('DELETE FROM review WHERE auction_id = :auction_id');
        $deleteReviewsQuery->bindParam(':auction_id', $auction_id, PDO::PARAM_INT);
        $deleteReviewsQuery->execute();

        // Delete auction from the database
        $deleteAuctionQuery = $connection->prepare('DELETE FROM auction WHERE auction_id = :auction_id');
        $deleteAuctionQuery->bindParam(':auction_id', $auction_id, PDO::PARAM_INT);
        $deleteAuctionQuery->execute();

        // If everything is successful, commit the transaction
        $connection->commit();

        $_SESSION['success_message'] = "Auction and associated bids deleted successfully.";
    } catch (PDOException $e) {
        // If an error occurs, rollback the transaction
        $connection->rollBack();

        $_SESSION['error_message'] = "Error deleting auction. Please try again.";

        // Log or handle the exception as needed
        // echo "Error: " . $e->getMessage();
    }

    // Redirect after deletion
    echo "<script>window.location.href = 'userAuction.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Auction</title>
</head>

<body>
    <h1>Delete Auction</h1>

    <?php
    if (isset($_SESSION['error_message'])) {
        echo "<p>{$_SESSION['error_message']}</p>";
        unset($_SESSION['error_message']);
    }

    if (isset($_SESSION['success_message'])) {
        echo "<p>{$_SESSION['success_message']}</p>";
        unset($_SESSION['success_message']);
    }
    ?>

    <p>Are you sure you want to delete this auction?</p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Hidden input field for auction_id -->
        <input type="hidden" name="auction_id" value="<?php echo htmlspecialchars($auction_id); ?>">

        <input type="submit" value="Delete Auction">
    </form>a<?php
// Start session to manage session variables
session_start();

// Include database connection file
include 'dbconnection.php';

// Check if auction ID is set in the URL parameters
if (isset($_GET['id'])) {
    $auction_id = $_GET['id']; // Store auction ID from URL
}

// Check if the form is submitted and auction ID is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['auction_id'])) {
    $auction_id = $_POST['auction_id']; // Retrieve auction ID from form data

    // Start a transaction to ensure data consistency
    $connection->beginTransaction();

    try {
        // Delete bids associated with the auction
        $deleteBidsQuery = $connection->prepare('DELETE FROM bid WHERE auction_id = :auction_id');
        $deleteBidsQuery->bindParam(':auction_id', $auction_id, PDO::PARAM_INT);
        $deleteBidsQuery->execute();

        // Delete reviews associated with the auction
        $deleteReviewsQuery = $connection->prepare('DELETE FROM review WHERE auction_id = :auction_id');
        $deleteReviewsQuery->bindParam(':auction_id', $auction_id, PDO::PARAM_INT);
        $deleteReviewsQuery->execute();

        // Delete the auction from the database
        $deleteAuctionQuery = $connection->prepare('DELETE FROM auction WHERE auction_id = :auction_id');
        $deleteAuctionQuery->bindParam(':auction_id', $auction_id, PDO::PARAM_INT);
        $deleteAuctionQuery->execute();

        // If everything is successful, commit the transaction
        $connection->commit();

        // Set success message to be displayed to the user
        $_SESSION['success_message'] = "Auction and associated bids deleted successfully.";
    } catch (PDOException $e) {
        // If an error occurs, rollback the transaction
        $connection->rollBack();

        // Set error message to be displayed to the user
        $_SESSION['error_message'] = "Error deleting auction. Please try again.";

        // Log or handle the exception as needed
        // echo "Error: " . $e->getMessage();
    }

    // Redirect the user after deletion
    echo "<script>window.location.href = 'userAuction.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Auction</title>
</head>

<body>
    <h1>Delete Auction</h1>

    <?php
    // Display error message if set in session
    if (isset($_SESSION['error_message'])) {
        echo "<p>{$_SESSION['error_message']}</p>";
        unset($_SESSION['error_message']); // Clear the error message from session
    }

    // Display success message if set in session
    if (isset($_SESSION['success_message'])) {
        echo "<p>{$_SESSION['success_message']}</p>";
        unset($_SESSION['success_message']); // Clear the success message from session
    }
    ?>

    <p>Are you sure you want to delete this auction?</p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Hidden input field to pass auction_id to the form submission -->
        <input type="hidden" name="auction_id" value="<?php echo htmlspecialchars($auction_id); ?>">

        <input type="submit" value="Delete Auction">
    </form>

    
</body>

</html>


    
</body>

</html>

