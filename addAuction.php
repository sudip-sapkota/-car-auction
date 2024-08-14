<?php
session_start();
    include 'dbconnection.php';
    // Include header and navigation bar
    include 'header.php';
    include 'nav.php';
    include 'loginBy.php';
    




// Redirect to login page if user is not logged in
if (!isset($_SESSION['username'])) {
    echo '<script type="text/javascript">';
            echo 'window.location.href = "login.php";';
            echo '</script>';
    exit();
}

// Fetch user ID from session
$username = $_SESSION['username'];
$userQuery = $connection->prepare('SELECT user_id FROM users WHERE username = :username');
$userQuery->execute(['username' => $username]);
$user = $userQuery->fetch(PDO::FETCH_ASSOC);

// Redirect with an error message if user is not found
if (!$user) {
    $_SESSION['error_message'] = "User not found";
    header("Location: addAuction.php");
    exit();
}

$user_id = $user['user_id'];

// Process auction form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auctionTitle = $_POST["auctionTitle"];
    $auctionDescription = $_POST["auctionDescription"];
    $auctionCategory = $_POST["auctionCategory"];
    $auctionEndDate = $_POST["auctionEndDate"];
    $startingBid = $_POST["startingBid"];

    // Check if a file was uploaded
    $photoPath = "";
    if (isset($_FILES["images"]) && $_FILES["images"]["error"] == UPLOAD_ERR_OK) {
        $uploadDir = "images/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $photoPath = $uploadDir . basename($_FILES["images"]["name"]);
        if (!move_uploaded_file($_FILES["images"]["tmp_name"], $photoPath)) {
            $photoPath = ""; // Set default value if file upload fails
        }
    }

    // Insert auction data into the database
    $insertAuctionQuery = $connection->prepare('INSERT INTO auction (user_id, title, description, categoryId, endDate, startingBid, photoPath) VALUES (:user_id, :title, :description, :categoryId, :endDate, :startingBid, :photoPath)');
    $criteria = [
        'user_id' => $user_id,
        'title' => $auctionTitle,
        'description' => $auctionDescription,
        'categoryId' => $auctionCategory,
        'endDate' => $auctionEndDate,
        'startingBid' => $startingBid,
        'photoPath' => $photoPath
    ];
    $insertAuctionQuery->execute($criteria);

    // Redirect to userAuction.php after successful insertion
    if ($insertAuctionQuery) {
        echo '<script type="text/javascript">';
        echo 'window.location.href = "userAuction.php";';
        echo '</script>';
        exit();
    } else {
        // Redirect to addAuction.php with error message if insertion fails
        $_SESSION['error_message'] = "Error creating auction. Please try again.";
        header("Location: addAuction.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
  <link rel="stylesheet" href="./styles/login.css">
  <link rel="stylesheet" href="./styles/carbuy.css">
    <link rel="stylesheet" href="./styles/add_edit_Auction.css" />
</head>
<body>
<img src="banners/1.jpg" alt="Banner" />
    <div class="container">
        <h1>Auction panel!</h1>
        <!-- Form for adding a new auction -->
        <form action="#" method="post" enctype="multipart/form-data">
            <label for="carTitle">Car Title:</label>
            <input type="text" id="carTitle" name="auctionTitle" required>

            <label for="carDescription">Car Description:</label>
            <textarea id="carDescription" name="auctionDescription" required></textarea>



            <label for="auctionCategory">Category:</label>
            <select id="auctionCategory" name="auctionCategory">
                <?php
                $select = $connection->prepare('SELECT name FROM categories');
                $select -> execute();
                $fetch = $select -> fetchAll(PDO:: FETCH_ASSOC);
                foreach ($fetch as $key) {
                   echo '<option value="' .$key['name'] . '">' .$key['name'] . '</option>';
                }
            ?>
            </select>

            <label for="startingBid">Starting Bid Amount (£):</label>
            <input type="number" id="startingBid" name="startingBid" min="0" step="0.1" required>

            <label for="auctionEndDate">Auction End Date:</label>
            <input type="datetime-local" id="auctionEndDate" name="auctionEndDate" required>

            <input type="file" id="auctionPhoto" name="images" accept="image/*">

            <button type="submit">Create Auction</button>
        </form>
    </div>
</body>
</html>
