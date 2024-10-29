<?php
$conn = new mysqli("127.0.0.1", "root", "", "311_Project_database");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$jsonFilePath = "table_data.json";
$jsonData = file_get_contents($jsonFilePath);
$data = json_decode($jsonData, true);

if ($data === null) {
    die("Error reading JSON file.");
}

foreach ($data as $row) {
    $course = $conn->real_escape_string($row['course']);
    $section = $conn->real_escape_string($row['section']);
    $faculty = $conn->real_escape_string($row['faculty']);
    $time = $conn->real_escape_string($row['time']);
    $room = $conn->real_escape_string($row['room']);
    $seats = $conn->real_escape_string($row['seats']);

    $sql = "INSERT INTO courses (course, section, faculty, time, room, seats_available)
            VALUES ('$course', '$section', '$faculty', '$time', '$room', '$seats')";

    if (!$conn->query($sql)) {
        echo "Error inserting data: " . $conn->error;
        break;
    }
}

$conn->close();
echo "Data imported successfully from JSON to database.";
?>
