<?php

    function update_profile($fullname, $email, $nsu_email, $completed_credit, $profile_image) {
        #connect to db
        $mysqli = connect();

        $sql = "UPDATE users SET fullname = '$fullname', email = '$email', nsu_email = '$nsu_email', completed_credit = $completed_credit WHERE nsu_id = ". $_SESSION['nsu_id'];

        if ($mysqli->query($sql) === TRUE) {
            // return "success";
        } else {
            return null;
        }

        if($profile_image['size'] != 0) {
            // Directory where the file will be uploaded
            $targetDir = "image/uploads/";

            if(is_dir($targetDir) || mkdir($targetDir)) {
                
                $fileName = basename($profile_image["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
                // Upload the file to the server
                if (move_uploaded_file($profile_image["tmp_name"], $targetFilePath)) {
                    // Insert the file path into the database
                    $sql = "UPDATE users SET profile_pic = '$targetFilePath' WHERE nsu_id = ". $_SESSION['nsu_id'];
                    if ($mysqli->query($sql) === TRUE) {
                        // return "success";
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            }
            else {
                return null;
            }
        }

        return 'success';
    }

?>