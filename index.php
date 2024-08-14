<?php
// Start session and include necessary files
session_start();
include_once 'dbconnection.php'; // Database connection
include_once 'loginBy.php'; // Login function

// Get search term from URL parameter
$search_term = isset($_GET['search']) ? $_GET['search'] : '';

// HTML structure for the page
echo "<!DOCTYPE html><html><head><title>Carbuy Auctions</title><link rel='stylesheet' href='./styles/carbuy.css' />
<link rel='stylesheet' href='./styles/login.css' />
</head>
<body>
<h3>$welcome_message</h3>"; // Welcome message

include_once 'header.php'; // Header
include_once 'nav.php'; // Navigation menu

// Show admin link if logged in as admin


// Show add auction link if logged in as regular user

echo '<img src="banners/1.jpg" alt="Banner" /><main>'; // Banner and main section
if (isset($_SESSION['admin_id'])) {
    echo '<a href="adminCategories.php">See Categories</a>';
}
if (isset($_SESSION['user'])) {
    echo '<a href="addAuction.php">Add Auction</a><br>';
    echo '<a href="userAuction.php">userAuction</a>';
}
echo '<h1>Latest Car Listings / Search Results / Category listing</h1><ul class="carList">'; // Section title

// Fetch and display auction data based on search term
try {
    // Prepare the SQL query based on whether a search term is provided or not
    if (!empty($search_term)) {
        $query = $connection->prepare("SELECT * FROM auction WHERE title LIKE :search_term OR description LIKE :search_term");
        $query->bindValue(':search_term', '%' . $search_term . '%', PDO::PARAM_STR);
    } else {
        $query = $connection->prepare("SELECT * FROM auction");
    }
    
    $query->execute();

    if ($query->rowCount() > 0) {
        foreach ($query as $key) {
            // Display auction details
            echo '<li><img src="' . $key['photoPath'] . '" alt="' . $key['title'] . '">
            <article><h2>' . $key['title'] . '</h2>
            <h2>' . $key['categoryId'] . '</h2>
            <h3>' . $key['description'] . '</h3>
            <h3>' . $key['endDate'] . '</h3><p class="price">
            Current bid:' . $key['startingBid'] . '
            </p><a href="auction.php?id=' . $key['auction_id'] . '" class="more auctionLink">More &gt;&gt;</a></article></li>';
        }
    } else {
        echo "<li>No auctions found.</li>"; // Display message if no auctions found
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); // Display error message if database error occurs
}

echo '</ul><footer>&copy; Carbuy 2024</footer></main></body></html>'; // Closing tags for footer and main section
?>
