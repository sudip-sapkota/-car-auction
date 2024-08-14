<?php
// Start a session and include the database connection script
session_start();
include 'dbconnection.php';

// Fetch categories from the database
$categories = $connection->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

// Fetch auctions specifically for estate cars
$auctions = $connection->query("SELECT * FROM auction WHERE categoryId = 'estate'")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set and viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title of the webpage -->
    <title>CarBuy</title>
    
    <!-- Stylesheets for page styling -->
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
