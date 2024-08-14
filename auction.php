<?php
session_start();
include_once 'dbconnection.php';

// Retrieve user ID if logged in
if (isset($_SESSION['username'])) {
    // Fetch auction details based on auction ID
    if (isset($_GET['id'])) {
        $auction_id = $_GET['id'];

        $auctionQuery = $connection->prepare("SELECT * FROM auction WHERE auction_id = :auction_id");
        $auctionQuery->execute(['auction_id' => $auction_id]);
        $auction = $auctionQuery->fetch(PDO::FETCH_ASSOC);

        if ($auction) {
            // Check if the user is logged in again
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $userQuery = $connection->prepare("SELECT user_id FROM users WHERE username = :username");
                $userQuery->execute(['username' => $username]);
                $user = $userQuery->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $user_id = $user['user_id'];

                    // Proceed with inserting the review if form submitted
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                        // Get review text from the form
                        $reviewText = isset($_POST['reviewtext']) ? $_POST['reviewtext'] : '';

                        if (!empty($reviewText)) {
                            try {
                                // Prepare the SQL statement
                                $query = $connection->prepare("INSERT INTO review (user_id, auction_id, review) VALUES (:user_id, :auction_id, :review)");
                                
                                // Bind parameters
                                $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                                $query->bindParam(':auction_id', $auction_id, PDO::PARAM_INT);
                                $query->bindParam(':review', $reviewText, PDO::PARAM_STR);
                                
                                // Execute the statement
                                $query->execute();
                                echo "Review submitted successfully.";
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                        } else {
                            echo "Review text cannot be empty.";
                        }
                    }
                } else {
                    echo "User not found.";
                }
            }

            // Fetch user details based on auction's user ID
            $userQuery = $connection->prepare("SELECT * FROM users WHERE user_id = :user_id");
            $userQuery->execute(['user_id' => $auction['user_id']]);
            $user = $userQuery->fetch(PDO::FETCH_ASSOC);

            // Process bid submission
            if (isset($_POST['submit_bid'])) {
                // Assuming the bid form has been submitted
                $bid_amount = $_POST['bid'];

                // Check if the bid is higher than the current startingBid amount
                if (floatval($bid_amount) > floatval($auction['startingBid'])) {
                    // Update the Bids table with the new bid or insert a new bid
                    $updateBidQuery = $connection->prepare("INSERT INTO bid (user_id, auction_id, bid_amount) VALUES (:user_id, :auction_id, :bid_amount)");
                    $updateBidQuery->execute([
                        'user_id' => $user['user_id'],
                        'auction_id' => $auction_id,
                        'bid_amount' => $bid_amount
                    ]);

                    // Update the current startingBid amount in the Auction table
                    $updateAuctionQuery = $connection->prepare("UPDATE auction SET startingBid = :bid_amount WHERE auction_id = :auction_id");
                    $updateAuctionQuery->execute([
                        'bid_amount' => $bid_amount,
                        'auction_id' => $auction_id
                    ]);

                    // Show message indicating bid success
                    echo "Bid placed successfully.";
                } else {
                    echo "Your bid must be higher than the current bid amount.";
                }
            }

            // Fetch bid history for the specific auction in descending order of bid amount
            try {
                $bidHistoryQuery = $connection->prepare("SELECT bid.*, users.username FROM bid INNER JOIN users ON bid.user_id = users.user_id WHERE bid.auction_id = :auction_id ORDER BY bid.bid_amount DESC");
                $bidHistoryQuery->execute(['auction_id' => $auction_id]);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // Display auction details and review form
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/carbuy.css" />
    <title><?php echo $auction['title']; ?></title>
    <script>
        // Function to update the time left
        function updateTimeLeft() {
            // Get the end date from PHP
            var endDate = new Date("<?php echo $auction['endDate']; ?>");

            // Calculate the time difference between now and the end date
            var now = new Date();
            var timeDiff = endDate - now;

            // Calculate hours and minutes
            var hours = Math.floor(timeDiff / (1000 * 60 * 60));
            var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

            // Display the updated time left
            document.getElementById("timeLeft").innerHTML = "Time left: " + hours + " hours " + minutes + " minutes";

            // Update every minute (adjust the interval as needed)
            setTimeout(updateTimeLeft, 60000);
        }

        // Call the function when the page loads
        window.onload = updateTimeLeft;
    </script>
</head>

<body>
    <h1>Car Page</h1>
    <main>
        <article class="car">
            <img src="<?php echo $auction['photoPath']; ?>" alt="<?php echo $auction['title']; ?>" style="width: 450px; height: 350px;">

            <section class="details">
                <h2><?php echo $auction['title']; ?></h2>
                <h3><?php echo $auction['categoryId']; ?></h3>
                <p>Auction created by <a href="#"><?php echo $user['username']; ?></a></p>
                <p class="price">Current bid: £<?php echo number_format($auction['startingBid'], 2); ?></p>
                <time id="timeLeft">Time left: Calculating...</time>
                <form action="#" class="bid" method="post">
                    <input type="text" name="bid" placeholder="Enter bid amount" />
                    <input type="submit" name="submit_bid" value="Place bid" />
                </form>
            </section>
            <section class="bid-history">
                <h2>Bid History</h2>
                <ul>
                    <?php
                    // Display bid history
                    while ($bid = $bidHistoryQuery->fetch(PDO::FETCH_ASSOC)) {
                        echo "<li>";
                        echo htmlspecialchars($bid['username']) . " placed a bid of £" . number_format($bid['bid_amount'], 2);
                        echo "</li>";
                    }
                    ?>
                </ul>
            </section>
            <section class="description">
                <p><?php echo $auction['description']; ?></p>
            </section>
            <section class="reviews">
                <h2>Reviews of Users</h2>
                <?php
                if ($user) {
                    // Fetch reviews for the specific auction
                    try {
                        $reviewQuery = $connection->prepare("SELECT review, users.Username FROM review INNER JOIN users ON review.user_id = users.user_id WHERE review.auction_id = :auction_id");
                        $reviewQuery->execute(['auction_id' => $auction_id]);

                        // Display reviews
                        echo "<ul>";
                        while ($review = $reviewQuery->fetch(PDO::FETCH_ASSOC)) {
                            echo "<li>";
                            echo "<strong>" . htmlspecialchars($review['Username']) . " said </strong>";
                            echo htmlspecialchars($review['review']);
                            echo "</li>";
                        }
                        echo "</ul>";
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $auction_id; ?>" method="post">
                    <label>Add your review</label>
                    <textarea name="reviewtext"></textarea>
                    <input type="submit" name="submit" />
                </form>
            </section>
        </article>
    </main>
    <hr />
    <footer>&copy; Carbuy 2024</footer>
</body>

</html>
<?php
        }
    }
} else {
    // Redirect to login page if user is not logged in
    echo "<script>window.location.href = 'userAuction.php';</script>";
    exit();
}
?>
