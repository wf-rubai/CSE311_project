<?php
// include MySQL.php class to other classes to connect to MySQL database

$config = json_decode(file_get_contents('config.json'), true);

$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
