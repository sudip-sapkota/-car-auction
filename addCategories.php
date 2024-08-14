<?php
session_start();

require 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission
    
    $name = $_POST['name'];

    // Insert new category into database
    $stmt = $connection->prepare("INSERT INTO categories (name) VALUES (:name)");
    $stmt->bindParam(':name', $name);
    $stmt->execute();

    // Redirect back to index.php
      echo '<script type="text/javascript">';
            echo 'window.location.href = "index.php";';
            echo '</script>';
    exit; // Make sure to exit after header redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="./styles/category.css">

</head>
<body>
    <h1>Add Category</h1>
    <form method="post">
        <label for="name">Category Name:</label>
        <input type="text" id="name" href="#"name="name" required>
        <button type="submit">Add Category</button>
    </form>
    <a href="adminCategories.php">Back to Categories</a>
</body>
</html>
