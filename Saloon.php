<?php
// Start the session
session_start();
// Include the database connection file
include 'dbconnection.php';

// Fetch categories from the database
$categories = $connection->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

// Fetch auctions for saloon category from the database
$auctions = $connection->query("SELECT * FROM auction WHERE categoryId = 'Saloon'")->fetchAll(PDO::FETCH_ASSOC);
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
    // Include the header and navigation bar
    include 'header.php';
    include 'nav.php';
    ?>

    <!-- Display banner image -->
    <img src="banners/1.jpg" alt="Banner" />

    <?php
    // Include the section for displaying auctions
    include 'section.php';
    ?>
</body>

</html>
