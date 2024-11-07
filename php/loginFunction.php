<?php

function login($nsu_id, $password) {
    $mysqli = connect();
    $nsu_id = trim($nsu_id);
    $password = trim($password);

    if($nsu_id == "" || $password == "") {
        return "Both fields are required";
    }

    $nsu_id = htmlspecialchars($nsu_id);
    $password = htmlspecialchars($password);

    $sql = "SELECT nsu_id, passkey FROM register_users WHERE nsu_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $nsu_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if($data == NULL) {
        return "Wrong username or password";
    }

    if(password_verify($password, $data["passkey"]) == FALSE) {
        return "Wrong password";
    }
    else {
        // $_SESSION["user"] = $email;
        // $_SESSION["first_name"] = $data["first_name"];
        // $_SESSION["last_name"] = $data["last_name"];
        // header("location: /profile");
        return "success";
    }
}

?>