<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$jsonData = file_get_contents("php://input");

$jsonFilePath = "table_data.json";
file_put_contents($jsonFilePath, $jsonData);

echo "Data saved successfully and JSON file created.";
?>
