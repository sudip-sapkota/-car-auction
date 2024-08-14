<?php
// Start session and include necessary files
session_start();
include 'dbconnection.php'; // Include database connection file
include 'loginBy.php'; // Include login function file
?>

<!DOCTYPE html>
<html>

<head>
    <title>Carbuy Auctions</title>
    <link rel="stylesheet" href="./styles/carbuy.css" />
    <link rel="stylesheet" href="./styles/login.css" />
</head>

<body>
    <h3><?php echo $welcome_message; ?></h3>

    <?php
    // Include header and navigation files
    include 'header.php';
    include 'nav.php';
    ?>

    <img src="banners/1.jpg" alt="Banner" />

    <main>
        <!-- Links to other pages -->
        <br>
        <a href="index.php">go to index page</a><br/>
        <a href="addAuction.php">Add Auction</a>

        <h1>Latest Car Listings / Search Results / Category listing</h1>

        <?php
        // Check if user is logged in and display their auctions
        if (isset($_SESSION['username']) && isset($_SESSION['user'])) {
            echo '<ul class="carList">';
            // Fetch auctions associated with the logged-in user
            $query = $connection->prepare('SELECT * FROM auction WHERE user_id = :id');
            $criteria = ['id' => $_SESSION['user']];
            $query->execute($criteria);
            foreach ($query as $key) {
                echo '<li>';
                echo '<img src="' . $key['photoPath'] . '" alt="' . $key['title'] . '">';
                echo '<article>';
                echo '<h2>' . $key['title'] . '</h2>';
                echo '<h2>' . $key['categoryId'] . '</h2>';
                echo '<h3>' . $key['description'] . '</h3>';
                echo '<h3>' . $key['endDate'] . '</h3>';
                echo '<p class="price">Current bid:' . $key['startingBid'] . '</p>';
                // Links to edit, delete, and view auction details
                echo '<a href="editAuction.php?id=' . $key['auction_id'] . '">Edit </a></br>';
                echo '<a href="deleteAuction.php?id=' . $key['auction_id'] . '"> Delete</a>';
                echo '<a href="auction.php?id=' . $key['auction_id'] . '" class="more auctionLink">More &gt;&gt;</a>';
                echo '</article>';
                echo '</li>';
            }
            echo '</ul>';
        }
        ?>

        <footer>
            &copy; Carbuy 2024
        </footer>
    </main>

</body>

</html>
