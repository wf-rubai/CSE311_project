<!-- use this iframe to add navigation bar -->
<!-- <iframe src="template/side_bar.html"  class="side_bar" id="sidebar" style="border: none; width: 250px; margin: 10px 0 10px 10px; display: none;"></iframe> -->
<?php 
    $user_details = checkLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            height: calc(100vh - 41px);
        }

        .side_bar {
            position: relative;
            padding: 20px;
            border-radius: 10px;
            height: 100%;
            overflow: hidden;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .side_bar::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url(https://images.unsplash.com/photo-1557683304-673a23048d34?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Z3JhZGllbnQlMjBiYWNrZ3JvdW5kfGVufDB8fDB8fHww);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transform: rotate(180deg);
            z-index: -1;
            filter: brightness(.5);
            /* opacity: 0.7; */
            /* Optional: adjust for visibility */
        }

        .side_bar:hover::before {
            filter: brightness(.6);
        }

        .nav_pro {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 15px 0;
        }

        .nav_pro_img {
            width: 100px;
            aspect-ratio: 1;
            overflow: hidden;
            display: flex;
            align-items: center;
            border-radius: 50%;
            border: 1.5px solid #ffffff;
        }

        .nav_pro_img img {
            width: 100%;
            transition: .5s;
        }

        .nav_pro_img img:hover {
            scale: 1.1;
        }

        .nav_pro h4 {
            margin: 10px 0;
        }
    </style>

    <style>
        .nav_option h4 {
            margin: 5px 0;
            /* height: 20px; */
            display: flex;
            align-items: center;
            padding: 5px 0;
            border: 2px solid #ffffff00;
            border-radius: 5px;
            transition: .3s;
            cursor: pointer;
        }

        .nav_option h4:hover {
            padding: 5px;
            background: #ffffff4f;
            border: 2px solid #ffffff9f;
        }

        .nav_option h4 i {
            width: 20px;
        }

        .nav_option h4 a {
            text-decoration: none;
            color: white;
        }

        .log_out_btn {
            display: flex;
            justify-content: center;
            gap: 5px;
            font-size: 14px;
            transition: .3s;
            cursor: pointer;
            padding: 10px;
        }

        .log_out_btn:hover {
            text-shadow: 0 0 15px white;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="side_bar">
        <div class="container">
            <div class="nav_pro">
                <div class="nav_pro_img">
                    <img src="../<?php echo $user_details['profile_pic']; ?>" alt="">
                </div>
                <h4><?php echo $user_details['fullname']; ?></h4>
            </div>

            <div class="nav_option">
                <h4><i class="fa-solid fa-caret-right"></i> <a onclick="navigateToPages('/profile')">Profile</a></h4>
                <h4><i class="fa-solid fa-caret-right"></i> <a onclick="navigateToPages('/generate_routine')">Routine Generate</a></h4>
                <h4><i class="fa-solid fa-caret-right"></i> <a onclick="navigateToPages('/custom_routine')">Custom Routine</a></h4>
                <h4><i class="fa-solid fa-caret-right"></i> <a onclick="navigateToPages('/saved_routine')">Saved Routines</a></h4>
                <h4><i class="fa-solid fa-caret-right"></i> <a onclick="navigateToPages('/faculty_review')">Faculty Review</a></h4>
            </div>
        </div>
        <div class="log_out_btn"> <a onclick="navigateToPages('/logout')">Log out <i class="fa-solid fa-right-from-bracket"></i></a></div>
        <!-- <h3>Navigate to</h3> -->
    </div>

    <script>
        // to navigate to home page upon click
        function navigateToPages(nextLocation) {
            window.parent.location = nextLocation; // Update this path as needed
        }

    </script>
</body>

</html>