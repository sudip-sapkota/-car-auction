<?php
session_start();

// Database connection
$servername = 'mysql';
$username = 'student';
$password = 'student';
$databasename='ijdb';
$pdo = new PDO('mysql:dbname=' . $databasename . ';host=' . $servername, $username, $password);

// Check if the connection is successful
if ($pdo){
    echo "Connected successfully";
}

// Retrieve category name from URL parameter
$name = $_GET['name'] ?? null;

// Process form submission if method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set
    if(isset($_POST['old_name']) && isset($_POST['new_name'])) {
        $oldName = $_POST['old_name'];
        $newName = $_POST['new_name'];

        // Update category in database
        $stmt = $pdo->prepare("UPDATE categories SET name = :newName WHERE name = :oldName");
        $stmt->bindParam(':newName', $newName);
        $stmt->bindParam(':oldName', $oldName);
        $stmt->execute();

        // Redirect to index.php after editing category
        echo '<script type="text/javascript">';
        echo 'window.location.href = "index.php";';
        echo '</script>';
        exit;
    }
}

// Fetch category details from database
$stmt = $pdo->prepare("SELECT * FROM categories WHERE name = :name");
$stmt->bindParam(':name', $name);
$stmt->execute();
$category = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="./styles/category.css">
</head>
<body>
    <h1>Edit Category</h1>
    <form method="post">
        <label for="old_name">Old Category Name:</label>
        <input type="text" id="old_name" name="old_name" value="<?php echo isset($category['name']) ? htmlspecialchars($category['name']) : ''; ?>" required><br>
        <label for="new_name">New Category Name:</label>
        <input type="text" id="new_name" name="new_name" required><br>
        <button type="submit">Update Category</button>
    </form>
    <a href="adminCategories.php">Back to Categories</a>
</body>
</html>
