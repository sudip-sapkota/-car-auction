<?php
session_start();

// Check if the user is logged in as admin


// Require the database connection file
require_once "dbconnection.php";

// Fetch categories from the database
$sql = "SELECT * FROM categories";
$result = $connection->query($sql);

if (!$result) {
    die("Error fetching categories: " . $connection->errorInfo()[2]);
}

$categories = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Categories</title>
    <link rel="stylesheet" href="./styles/category.css">
<!-- -->
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Admin Categories</h1>
        <form>
    <a href="addCategories.php" class="button">Add New Category</a>
    <a href="editCategory.php" class="button">Edit Category</a>
    <a href="deleteCategory.php" class="button">Delete Category</a>
    <a href="index.php" class="button">Home</a>
</form>

    </div>
</body>
</html>
