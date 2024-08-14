<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // Set up connection parameters
        $servername = 'mysql'; // Assuming MySQL server is named 'mysql'
        $username = 'student'; // Username for database access
        $password = 'student'; // Password for database access
        $databasename = 'ijdb'; // Name of the database to connect to

        // Create a new PDO connection using the provided parameters
        $connection = new PDO(('mysql:dbname=') . $databasename . ';host=' . $servername, $username, $password);
    ?>
</body>
</html>
