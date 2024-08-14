<?php
session_start();
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["loginUsername"], $_POST["loginPassword"])) {
    $stmt = $connection->prepare('SELECT * FROM admins WHERE username = ?');
    $stmt->execute([$_POST["loginUsername"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($_POST["loginPassword"], $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['admin_id'] = $user['admin_id'];
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    }
}

echo "Incorrect password or username.";
?>