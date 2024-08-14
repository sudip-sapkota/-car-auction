<?php
session_start();
require 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkAdminQuery = $connection->query('SELECT COUNT(*) AS num_admins FROM admins');
    $numAdmins = $checkAdminQuery->fetch(PDO::FETCH_ASSOC)['num_admins'];

    if ($numAdmins == 0) {
        $email = $_POST["email"];
        $username = $_POST["Username"];
        $password = $_POST["Password"];
        $confPassword = $_POST["confPassword"];

        if ($password === $confPassword) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertdata = $connection->prepare('INSERT INTO admins (email, Username, Password) VALUES (:email, :Username, :Password)');
            $insertdata->bindParam(':email', $email);
            $insertdata->bindParam(':Username', $username);
            $insertdata->bindParam(':Password', $hashedPassword);

            if ($insertdata->execute()) {
                echo 'Admin registration successful! Welcome, ' . $username . '! <br/>';
                echo "<script>window.location.href = 'admin_login.php';</script>";
                echo 'Get back to the login page and login.';
            } else {
                echo 'Error inserting data.';
            }
        } else {
            echo  'Please make sure your passwords match.';
        }
    } else {
        echo 'Sorry, only one admin can register.';
    }
}
