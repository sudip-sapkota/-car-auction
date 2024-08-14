<?php
// Start a session and connect to the database
session_start();
include 'dbconnection.php'; // Including the database connection file

// Fetch categories from the database
$categories = $connection->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

// Fetch auctions specifically for electric cars
$auctions = $connection->query("SELECT * FROM auction WHERE categoryId = 'electric'")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarBuy</title>
    <link rel="stylesheet" href="./styles/carbuy.css" /> <!-- Linking to the CSS file for general styling -->
    <link rel="stylesheet" href="./styles/login.css" /> <!-- Linking to the CSS file for login-specific styling -->
</head>

<body>
    <?php
    // Including header and navigation bar files
    include 'header.php';
    include 'nav.php';
    ?>

    <!-- Displaying a banner -->
    <img src="banners/1.jpg" alt="Banner" />

    <?php
    // Including a section for displaying content
    include 'section.php';
    ?>
</body>

</html>
