<?php
// Start a session and connect to the database
session_start();
include 'dbconnection.php';

// Fetch categories from the database
$categories = $connection->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

// Fetch auctions specifically for 4*4 cars
$auctions = $connection->query("SELECT * FROM auction WHERE categoryId = '4x4'")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarBuy</title>
    <link rel="stylesheet" href="./styles/carbuy.css" />
    <link rel="stylesheet" href="./styles/login.css" />
</head>

<body>
    <?php
    // Include header and navigation bar
    include 'header.php';
    include 'nav.php';
    ?>

    <!-- Display a banner -->
    <img src="banners/1.jpg" alt="Banner" />

    <?php
    // Include a section for displaying content
    include 'section.php';
    ?>
</body>

</html>
