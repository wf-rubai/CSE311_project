<?php

    require "php/profileFunction.php";

    #connect to db
    $mysqli = connect();

    $user_details = checkLogin(); 

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json');
        if(isset($_POST['update_profile'])) {
            $response = update_profile($_POST['fullname'], $_POST['email'], $_POST['nsu_email'], $_FILES['profile_image']);
            if($response != null) {
                echo json_encode(['message' => 'success', 'redirectUrl' => '/profile']);
            }
            else {
                echo json_encode(['message' => 'Something went wrong!']);
            }
        }
        exit();
    } 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js/common.js"></script>
    <title>Member Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            scrollbar-width: none;
        }

        *::-webkit-scrollbar {
            display: none;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            height: calc(100vh - 60px);
            display: flex;
        }

        .main_body {
            background: #e2e2e2;
            width: -webkit-fill-available;
            border-radius: 10px;
            margin: 10px;
            overflow-y: auto;
        }

        .profile-section {
            display: flex;
        }

        .profile-section,
        .main_bg {
            padding: 20px;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            justify-content: center;
            /* background: linear-gradient(to right, #ff5b5b, #ff68a6); */
            background: linear-gradient(to right, #32334d, #5a3e49);
            position: relative;
            height: -webkit-fill-available;
            overflow: hidden;
        }

        .bg_img {
            position: absolute;
            opacity: .1;
            min-width: 100%;
        }

        .profile-header {
            text-align: center;
        }

        .profile-header h1 {
            font-size: 32px;
            color: #1a1a2e;
            margin-bottom: 8px;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, 10px);
            color: white;
        }

        .profile-header h2 {
            font-size: 22px;
            color: #555;
        }
    </style>

    <style>
        .academic-info {
            background-color: #f9f9f950;
            border-radius: 10px;
            padding: 20px;
            line-height: 1.6;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: background-color 0.3s ease;
            color: white;
        }

        .academic-info h4 {
            color: #444;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .academic-info p {
            font-size: 16px;
            margin: 6px 0;
            /* color: #444; */
        }

        .academic-info table {
            width: 100%;
            border-collapse: collapse;
            background: #fafafa50;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .academic-info th,
        .academic-info td {
            padding: 12px 15px;
            text-align: left;
            font-size: 16px;
        }

        .academic-info th {
            background-color: #f0f0f050;
            color: #444;
            font-weight: bold;
        }

        .academic-info td {
            color: #555;
        }

        .academic-info tr:hover td {
            background-color: #e8f4ff50;
        }

        .update_profile {
            height: fit-content;
            padding: 5px 10px;
            border: 1px solid #585858;
            color: #585858;
            background: none;
            border-radius: 7px;
            transition: .5s;
        }

        .update_profile:hover {
            border: 1px solid #ffffff00;
            color: #585858;
            background: #ffffff50;
        }
    </style>

    <style>
        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #fafafa50;
            border-radius: 12px;
            padding: 100px 20px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            position: relative;
            text-align: center;
            width: 300px;
        }

        .profile-info::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            border-radius: 12px 12px 0 0;
            z-index: -1;
        }

        .profile-pic {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #ffffff00;
            position: absolute;
            top: -100px;
            background: #ffffff60;
            backdrop-filter: blur(5px);
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .5s;
        }

        .profile-pic img:hover {
            scale: 1.1;
        }

        .profile-details h3 {
            font-size: 24px;
            color: #333;
            margin-top: 40px;
        }

        .profile-details p {
            margin: 5px 0;
            color: #555;
        }

        .profile_container {
            display: flex;
            width: 100%;
            justify-content: center;
            gap: 20px;
            align-items: flex-end;
            z-index: 1;
        }
    </style>

    <style>
        .edit_section {
            display: none;
        }

        .edit_info {
            display: flex;
        }

        .edit_part_1 {
            padding: 20px;
            width: 320px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            background: #ffffff79;
            border-radius: 10px 0 0 10px;
            z-index: 1;
        }

        .edit_part_1 table tr td input,
        .edit_part_2 .academic-info table tr td input {
            width: -webkit-fill-available;
            margin: 5px 0;
            padding: 5px;
            background: #ffffff50;
            border: 2px solid #ffffff50;
            border-radius: 7px;
        }

        .edit_part_1 table tr th {
            width: 25%;
            text-align: left;
            font-size: 15px;
            color: #333;
            font-weight: normal;
        }

        .edit_part_1 table {
            width: -webkit-fill-available;
        }

        .edit_profile {
            position: relative;
            top: 0;
            width: 200px;
            height: 200px;
        }

        .edit_part_2 {
            z-index: 1;
        }

        .edit_part_2 .academic-info {
            border-radius: 0 10px 10px 0;
            height: -webkit-fill-available;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .edit_part_2 .academic-info h4 {
            margin: 0 0 10px 0;
        }

        .edit_btn {
            height: fit-content;
            padding: 5px 10px;
            border: 1px solid #585858;
            color: #585858;
            background: none;
            border-radius: 7px;
            transition: .5s;
            margin: 10px 0 0 10px;
        }

        /* .edit_cancle {
            border: 1px solid #540000;
            color: #540000;
        } */

        .edit_btn:hover {
            border: 1px solid #ffffff00;
            color: #585858;
            background: #ffffff50;
        }

        .change_img {
            scale: 1.3;
            width: 20px;
            height: 20px;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            border-radius: 50%;
            border: 2px solid #ffffff;
            position: absolute;
            right: 15px;
            bottom: 25px;
            color: #a5a5a5;
            transition: .5s;
            content: "ajsdfa;";
        }

        .change_img:hover {
            scale: 1.5;
            color: #333;
            /* width: fit-content; */
            content: "Change Profile";
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <iframe src="template/nav_bar.html" style="border: none; width: 100%; height: 60px; display: block;"></iframe>

    <div class="container">
        <!-- Sidebar -->
        <iframe src="template/side_bar.html" class="side_bar" id="sidebar"
            style="border: none; width: 250px; margin: 10px 0 10px 10px; display: none;"></iframe>

        <!-- Main Content -->
        <div class="main_body">
            <div class="profile-section main_bg">
                <!-- Header -->
                <div class="profile-header">
                    <h1>Student Profile</h1>
                </div>

                <div class="profile_container">
                    <!-- Profile Information -->
                    <div class="profile-info">
                        <div class="profile-pic">
                            <img src="<?php if(isset($user_details['profile_pic'])) {echo $user_details['profile_pic'];} else {echo '/image/no_profile_pic.jpg';} ?>" alt="Profile Picture">
                        </div>
                        <div class="profile-details">
                            <h3><?php if(isset($user_details['fullname'])) {echo $user_details['fullname'];} ?></h3>
                            <p><strong>ID:</strong> <?php if(isset($user_details['nsu_id'])) {echo $user_details['nsu_id'];} ?></p>
                            <p><strong>Email:</strong> <?php if(isset($user_details['email'])) {echo $user_details['email'];} ?></p>
                            <p><strong>NSU Email:</strong> <?php if(isset($user_details['nsu_email'])) {echo $user_details['nsu_email'];} ?></p>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="academic-info">
                        <div style="display: flex; justify-content: space-between;">
                            <h4>Student Info</h4>
                            <button class="update_profile" onclick="swap_section()"><i
                                    class="fa-solid fa-pen-to-square"></i> Update
                                profile</button>

                        </div>
                        <table>
                            <tr>
                                <th>Department</th>
                                <td>Electrical Computer Engineering</td>
                            </tr>
                            <tr>
                                <th>Current Semester</th>
                                <td>Summer 2024</td>
                            </tr>
                            <tr>
                                <th>Enrolled In</th>
                                <td>Bachelor of Science in Computer Science and Engineering</td>
                            </tr>
                            <tr>
                                <th>Total Credit</th>
                                <td>130 Credit</td>
                            </tr>
                            <tr>
                                <th>Completed Credit</th>
                                <td>58 Credit</td>
                            </tr>
                            <tr>
                                <th>Degree Analysis</th>
                                <td>Not yet</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <img class="bg_img" src="../image/Slide1.jpg" alt="">

            </div>

            <div class="edit_section main_bg">
                <form id="edit_form" enctype="multipart/form-data">
                    <div class="edit_info">
                        <div class="edit_part_1">
                            <div style="position: relative;">
                                <div class="profile-pic edit_profile">
                                    <img src="<?php if(isset($user_details['profile_pic'])) {echo $user_details['profile_pic'];} else {echo '/image/no_profile_pic.jpg';} ?>" alt="">
                                </div>
                                <div class="change_img">
                                    <i class="fa-solid fa-pen-to-square" onclick="document.getElementById('image_change_file').click()"></i>
                                    <input type="file" name="profile_image" id="image_change_file" hidden>
                                </div>
                            </div>
                            <table>
                                <tr>
                                    <th>Name</th>
                                    <td>
                                        <input type="text" name="fullname" id="" placeholder="Name" value="<?php if(isset($user_details['fullname'])) {echo $user_details['fullname'];} ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>NSU ID</th>
                                    <td>
                                        <input type="text" name="nsu_id" disabled id="" placeholder="ID" value="<?php if(isset($user_details['nsu_id'])) {echo $user_details['nsu_id'];} ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <input type="text" name="email" id="" placeholder="Email" value="<?php if(isset($user_details['email'])) {echo $user_details['email'];} ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>NSU Email</th>
                                    <td>
                                        <input type="text" name="nsu_email" id="" placeholder="NSU Email" value="<?php if(isset($user_details['nsu_email'])) {echo $user_details['nsu_email'];} ?>">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="edit_part_2">
                            <!-- Academic Information -->
                            <div class="academic-info">
                                <div style="display: flex; justify-content: space-between;">
                                    <h4>Student Info</h4>
                                </div>
                                <table>
                                    <tr>
                                        <th>Department</th>
                                        <td>Electrical Computer Engineering</td>
                                    </tr>
                                    <tr>
                                        <th>Enrolled In</th>
                                        <td>Bachelor of Science in Computer Science and Engineering</td>
                                    </tr>
                                    <tr>
                                        <th>Completed Credit</th>
                                        <td>
                                            <input type="text" name="" id="" placeholder="" value="58">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Degree Analysis</th>
                                        <td>
                                            <input type="text" name="" id="" placeholder="" value="Not yet">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td>
                                            <input type="password" name="" id="" placeholder="" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Confirm Password</th>
                                        <td>
                                            <input type="password" name="" id="" placeholder="" value="">
                                        </td>
                                    </tr>
                                </table>
    
                                <div style="display: flex; justify-content: flex-end;">
                                    <button type="button" class="edit_btn edit_cancle" onclick="swap_section()">Cancle</button>
                                    <button type="submit" class="edit_btn edit_update" onclick="">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="bg_img" src="../image/Slide1.jpg" alt="">
                </form>
            </div>
        </div>
    </div>

    <script>
        function swap_section() {
            const profileSection = document.querySelector(".profile-section");
            const editSection = document.querySelector(".edit_section");

            // Toggle display property
            if (profileSection.style.display === "flex") {
                profileSection.style.display = "none";
                editSection.style.display = "flex";
            } else {
                profileSection.style.display = "flex";
                editSection.style.display = "none";
            }
        }
    </script>

    <script>
        document.getElementById('edit_form').addEventListener('submit', function (e) {
            e.preventDefault();

            sendPostRequestForm('/profile', this, 'update_profile').then(response => {
                if (response.message != 'success') {
                    alert(response.message); // Display error message
                }
            });
        });


    </script>

</body>

</html>