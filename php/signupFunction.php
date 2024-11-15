<?php

function signup($nsu_id, $email, $password, $confirm_password) {
    #connect to db
    $mysqli = connect();

    if(strlen($nsu_id) > 7) {
        return "NSU ID must be 7 characters long";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Email not valid";
    }

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE nsu_id = ?");
    $stmt->bind_param("s", $nsu_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if($data != NULL) {
        return "ID already exists, please login instead";
    }

    if($password != $confirm_password) {
        return "Passwords don't match";
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users(nsu_id, email, passkey) VALUES (?,?,?)");
    $stmt->bind_param("sss", $nsu_id, $email, $hashed_password);
    $stmt->execute();
    if($stmt->affected_rows != 1) {
        return "Error occured. Please try again";
    }
    else {
        return "success";
    }
}

?>