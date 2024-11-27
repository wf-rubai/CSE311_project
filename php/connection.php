<?php

include "config.php";

function connect() {
    $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if($mysqli->connect_errno != 0) {
        $error = $mysqli->connect_error;
        $error_date = date("F j, Y, g:i a");
        $message = "{$error} | {$error_date}\r\n";
        file_put_contents("db-log.txt", $message, FILE_APPEND);
        return false;
    }
    else {
        return $mysqli;
    }
}

function checkLogin() {
    
    $mysqli = connect();

    if(isset($_SESSION['nsu_id'])) {

        // Query to get all data from the table
        $sql = "SELECT * FROM users WHERE nsu_id = " . $_SESSION['nsu_id'];
        $result = $mysqli->query($sql);
    
        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output data of the first row (or loop through rows if needed)
            $user_details = $result->fetch_assoc();  // Fetch a single row as an associative array
    
        } else {
            echo "No user found with nsu_id = 2232450";
        }

        return $user_details;
    }
    else {
        header('Location: /login');
    }
}

?>