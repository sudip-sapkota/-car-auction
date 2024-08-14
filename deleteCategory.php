<?php
session_start();

// Include database connection
require_once 'dbconnection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve category name from form
    $name = $_POST['category_name'] ?? null;

    if ($name) {
        // Delete category from database
        $stmt = $connection->prepare("DELETE FROM categories WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        echo '<script type="text/javascript">';
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Category</title>
    <link rel="stylesheet" href="./styles/category.css">
</head>
<body>
    <h2>Delete Category</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" required>
        <button type="submit">Delete</button>
    </form>
    <a href="adminCategories.php">Back to Categories</a>
</body>
</html>
