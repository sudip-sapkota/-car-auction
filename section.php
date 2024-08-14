<?php
// This section displays the list of auctions
if (!empty($auctions)) {
    // Check if there are any auctions available

    // Create an unordered list with a class of "carList"
    echo '<ul class="carList">';
    
    // Iterate through each auction in the $auctions array
    foreach ($auctions as $auction) {
        echo '<li>';
        
        // Display the auction's photo
        echo '<img src="' . $auction['photoPath'] . '" alt="' . $auction['title'] . '">';
        
        // Create an article element to hold the auction details
        echo '<article>';
        
        // Display the auction's title
        echo '<h2>' . htmlspecialchars($auction['title']) . '</h2>';
        
        // Display the auction's description
        echo '<h3>' . htmlspecialchars($auction['description']) . '</h3>';
        
        // Display the auction's end date
        echo '<h3>' . htmlspecialchars($auction['endDate']) . '</h3>';
        
        // Display the auction's category ID
        echo '<h3>' . htmlspecialchars($auction['categoryId']) . '</h3>';
        
        // Display the current bid for the auction
        echo '<p class="price">Current bid: £' . htmlspecialchars($auction['startingBid']) . '</p>';
        
        // Create a link to the auction page
        echo '<a href="auction.php?id=' . $auction['auction_id'] . '" class="more auctionLink">More &gt;&gt;</a>';
        
        // Close the article element and list item
        echo '</article>';
        echo '</li>';
    }
    
    // Close the unordered list
    echo '</ul>';
} else {
    // No auctions found in this category
    echo '<p>No auctions found in this category.</p>';
}
?>