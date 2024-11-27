<?php

function login($nsu_id, $password) {
    $mysqli = connect();
    $nsu_id = trim($nsu_id);
    $password = trim($password);

    if($nsu_id == "" || $password == "") {
        return "Both fields are required";
    }

    // $nsu_id = htmlspecialchars($nsu_id);
    // $password = htmlspecialchars($password);

    $sql = "SELECT nsu_id, passkey, fullname, is_admin FROM users WHERE nsu_id = ?";
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
        $_SESSION["nsu_id"] = $nsu_id;
        $_SESSION["fullname"] = $data["fullname"];
        // header("location: /profile");
        return ['message' => "success", 'is_admin' => $data['is_admin']];
    }
}

?>