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

?>