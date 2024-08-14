<nav>
    <ul>
        <?php
        // Fetch categories from the database and display them as links
        $categoriesQuery = $connection->prepare("SELECT * FROM categories");
        $categoriesQuery->execute();
        while ($category = $categoriesQuery->fetch(PDO::FETCH_ASSOC)) {
            // Display each category as a list item with a link
            echo '<li><a class="categoryLink" href="' . strtolower($category['name']) . '.php">' . $category['name'] . '</a></li>';
        }
        ?>
        <?php
        // Fetch categories again for later use
        $stmt = $connection->prepare("SELECT * FROM categories");
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- Link to add a new category -->
        

        <!-- Dropdown for login/logout -->
        <li class="dropdown">
            <?php
            // Check if a user is logged in
            if (isset($_SESSION['username'])) {
                // If logged in, display logout link
                echo '<a class="categoryLink" href="logout.php" onclick="toggleDropdown()">Logout</a>';
            } else {
                // If not logged in, display login link and options
                echo '<a class="categoryLink" href="#" onclick="toggleDropdown()">Login</a>
                    <div class="dropdown-content" id="dropdownContent">
                        <a href="admin_register.php">Admin</a>
                        <a href="register.php">User</a>';
                echo '</div>';
            }
            ?>
        </li>
    </ul>
</nav>

<!-- JavaScript function to toggle the dropdown menu -->
<script>
    function toggleDropdown() {
        // Get the dropdown content element by its ID
        var dropdownContent = document.getElementById("dropdownContent");
        // Toggle its display style between block and none
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none"; // Hide the dropdown
        } else {
            dropdownContent.style.display = "block"; // Show the dropdown
        }
    }
</script>
