<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js/common.js"></script>
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            /* background-image: url('https://i0.wp.com/backgroundabstract.com/wp-content/uploads/edd/2021/09/gradient-blue-pink-abstract-art-wallpaper-preview-e1656162284223.jpg?fit=728%2C410&ssl=1');
            background-repeat: no-repeat;
            background-size: cover; */
            /* background-image: linear-gradient(to right, #1f0033, #09000f); */
            height: calc(100vh - 60px);
            display: flex;
        }

        .main_body {
            /* background: #0000001f; */
            /* background-image: linear-gradient(136deg, #cc00ac, #6a00af, #0036af); */
            background: linear-gradient(to right, #32334d, #5a3e49);
            width: -webkit-fill-available;
            border-radius: 10px;
            margin: 10px;
            overflow-y: hidden;
            backdrop-filter: blur(15px);
            /* border: 2px solid #ffffff80; */
        }

        .bg_img {
            position: absolute;
            opacity: .1;
            min-width: 100%;
            z-index: -1;
        }
    </style>
    <!-- search box css -->
    <style>
        .search_field {
            display: flex;
            justify-content: center;
            margin: 20px;
        }

        .search_field input {
            width: 43%;
            padding: 5px;
            border: 1.5px solid #ffffff80;
            border-radius: 5px;
            background-color: #ffffff90;
        }

        #courseList {
            display: none;
            border: 1.5px solid #b8b8b8;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            width: 100%;
            background-color: #4f4f4fa8;
            z-index: 10;
            padding: 5px;
            border-radius: 5px;
            transition: .5s;
            backdrop-filter: blur(30px);
            color: white;
        }

        .dropdown-item {
            padding: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background-color: #518eff;
            border-radius: 5px;
        }
    </style>
    <!-- scroll feed css -->
    <style>
        .scroll_feed {
            height: calc(100% - 67.5px);
            margin: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .review_block {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0;
            width: 50%;
        }

        .main_rev {
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            width: -webkit-fill-available;
            background: #ffffff36;
            padding: 10px;
            border-radius: 10px;
            border: 2px solid #ffffff80;
        }

        .fac_profile {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .fac_profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .fac_profile h3 {
            font-size: 18px;
            color: #ffffff;
        }

        .rev_bars {
            display: flex;
            gap: 15px;
            width: 100%;
        }

        .rev {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 50%;
        }

        .rev h4 {
            font-size: 14px;
            color: #ffffff;
            margin: 5px 0;
        }

        .rev input[type="range"] {
            width: 100%;
            height: 8px;
            margin: 0;
            background: linear-gradient(to right, #ff9800, #ff9800) no-repeat;
            background-size: 50% 100%;
            -webkit-appearance: none;
            appearance: none;
            border-radius: 4px;
            background-color: #aaa;
        }

        .rev input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 0;
            width: 0;
            background: #ff9800;
            cursor: pointer;
        }

        .rev input[type="range"]::-moz-range-thumb {
            height: 0;
            width: 0;
            background: #ff9800;
            cursor: pointer;
        }

        .rev_opt {
            display: flex;
            gap: 15px;
            flex-direction: column;
            height: 100%;
        }

        .rev_opt div {
            display: flex;
            font-size: 20px;
            color: #ffffff;
            cursor: pointer;
            transition: color 0.3s;
            height: 30%;
            aspect-ratio: 1;
            background: #ffffff36;
            margin-left: 10px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid #ffffff80;
            transition: .3s;
        }

        .rev_opt div:hover {
            box-shadow: 0 0 10px 0 #fff;
        }
    </style>
    <!-- comment modal css -->
    <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1060;
        }

        .modal_content {
            background: #333;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            color: #fff;
            overflow-y: auto;
            max-height: 80vh;
        }

        .modal_content h2 {
            margin-top: 0;
            color: #ff9800;
        }

        .comments_section {
            margin-top: 15px;
        }

        .comment {
            padding: 15px;
            background: #444;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .comment_header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile_pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment_info h3 {
            margin: 0;
            font-size: 16px;
        }

        .comment_date {
            font-size: 12px;
            color: #aaa;
        }

        .comment_text {
            margin: 10px 0;
            color: #ddd;
        }

        /* Review styling for comments */
        .reviews {
            display: flex;
            gap: 15px;
        }

        .reviews .rev {
            width: 100%;
        }

        .reviews .rev h4 {
            font-size: 14px;
            color: #ff9800;
            margin-bottom: 5px;
        }

        .reviews .rev input[type="range"] {
            width: 100%;
            height: 8px;
            margin: 0;
            background: linear-gradient(to right, #ff9800, #ff9800) no-repeat;
            background-size: 50% 100%;
            -webkit-appearance: none;
            appearance: none;
            border-radius: 4px;
            background-color: #aaa;
        }

        .reviews .rev input[type="range"]::-webkit-slider-thumb,
        .reviews .rev input[type="range"]::-moz-range-thumb {
            -webkit-appearance: none;
            appearance: none;
            height: 0;
            width: 0;
            background: #ff9800;
            cursor: pointer;
        }
    </style>
    <!-- review modal css -->
    <style>
        .modal_review {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1060;
        }

        .modal_content {
            background: #333;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 500px;
            color: #fff;
        }

        .modal_content h2 {
            color: #ff9800;
            margin-top: 0;
        }

        .anonymous_check {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .anonymous_check input[type="checkbox"] {
            margin-right: 8px;
        }

        .review_section {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .rev_to_give {
            width: 50%;
        }

        .rev_to_give h4 {
            color: #ff9800;
            margin: 5px 0;
            font-size: 14px;
        }

        .rev_to_give input[type="range"] {
            appearance: none;
            accent-color: #ff9800;
            width: 100%;
            height: 8px;
            margin: 0;
            background: #4c4c4c;
            border-radius: 4px;
        }

        .modal_buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 15px;
        }

        button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #cancel_button {
            background-color: #555;
            color: #fff;
        }

        #submit_button {
            background-color: #ff9800;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- navigation bar -->
    <iframe src="template/nav_bar.html" style="border: none; width: 100%; height: 60px; display: block;"></iframe>

    <div class="container">
        <!-- side bar -->
        <iframe src="template/side_bar.html" class="side_bar" id="sidebar"
            style="border: none; width: 250px; margin: 10px 0 10px 10px; display: none;"></iframe>

        <!-- all main content here -->
        <div class="main_body">
            <img class="bg_img" src="../image/Slide1.jpg" alt="">
            <div class="search_field">
                <div style="width: 300px; position: relative;">
                    <input style="width: 312px;" type="search" id="search_box_course" placeholder="Search faculty"
                        onfocus="filterList()" required>
                    <div id="courseList" class="dropdown-list"></div>
                </div>
            </div>

            <div class="scroll_feed">

                <div class="review_block">
                    <div class="main_rev">
                        <div class="fac_profile">
                            <img src="../image/no_profile_pic.jpg" alt="">
                            <h3>Faculty Initial (FIn)</h3>
                        </div>
                        <div class="rev_bars">
                            <div class="rev">
                                <h4>For Learning</h4>
                                <input type="range" min="1" max="100" value="0" id="learn_rev">
                            </div>
                            <div class="rev">
                                <h4>For Grading</h4>
                                <input type="range" min="1" max="100" value="0" id="grade_rev">
                            </div>
                        </div>
                    </div>
                    <div class="rev_opt">
                        <div class="fac_comment">
                            <i class="fa-regular fa-message"></i>
                        </div>
                        <div class="write_rev">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                </div>
                <div class="review_block">
                    <div class="main_rev">
                        <div class="fac_profile">
                            <img src="../image/no_profile_pic.jpg" alt="">
                            <h3>Faculty Initial (FIn)</h3>
                        </div>
                        <div class="rev_bars">
                            <div class="rev">
                                <h4>For Learning</h4>
                                <input type="range" min="1" max="100" value="0" id="learn_rev">
                            </div>
                            <div class="rev">
                                <h4>For Grading</h4>
                                <input type="range" min="1" max="100" value="0" id="grade_rev">
                            </div>
                        </div>
                    </div>
                    <div class="rev_opt">
                        <div class="fac_comment">
                            <i class="fa-regular fa-message"></i>
                        </div>
                        <div class="write_rev">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                </div>
                <div class="review_block">
                    <div class="main_rev">
                        <div class="fac_profile">
                            <img src="../image/no_profile_pic.jpg" alt="">
                            <h3>Faculty Initial (FIn)</h3>
                        </div>
                        <div class="rev_bars">
                            <div class="rev">
                                <h4>For Learning</h4>
                                <input type="range" min="1" max="100" value="0" id="learn_rev">
                            </div>
                            <div class="rev">
                                <h4>For Grading</h4>
                                <input type="range" min="1" max="100" value="0" id="grade_rev">
                            </div>
                        </div>
                    </div>
                    <div class="rev_opt">
                        <div class="fac_comment">
                            <i class="fa-regular fa-message"></i>
                        </div>
                        <div class="write_rev">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                </div>
                <div class="review_block">
                    <div class="main_rev">
                        <div class="fac_profile">
                            <img src="../image/no_profile_pic.jpg" alt="">
                            <h3>Faculty Initial (FIn)</h3>
                        </div>
                        <div class="rev_bars">
                            <div class="rev">
                                <h4>For Learning</h4>
                                <input type="range" min="1" max="100" value="0" id="learn_rev">
                            </div>
                            <div class="rev">
                                <h4>For Grading</h4>
                                <input type="range" min="1" max="100" value="0" id="grade_rev">
                            </div>
                        </div>
                    </div>
                    <div class="rev_opt">
                        <div class="fac_comment">
                            <i class="fa-regular fa-message"></i>
                        </div>
                        <div class="write_rev">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                </div>
                <div class="review_block">
                    <div class="main_rev">
                        <div class="fac_profile">
                            <img src="../image/no_profile_pic.jpg" alt="">
                            <h3>Faculty Initial (FIn)</h3>
                        </div>
                        <div class="rev_bars">
                            <div class="rev">
                                <h4>For Learning</h4>
                                <input type="range" min="1" max="100" value="0" id="learn_rev">
                            </div>
                            <div class="rev">
                                <h4>For Grading</h4>
                                <input type="range" min="1" max="100" value="0" id="grade_rev">
                            </div>
                        </div>
                    </div>
                    <div class="rev_opt">
                        <div class="fac_comment">
                            <i class="fa-regular fa-message"></i>
                        </div>
                        <div class="write_rev">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                </div>
                <div class="review_block">
                    <div class="main_rev">
                        <div class="fac_profile">
                            <img src="../image/no_profile_pic.jpg" alt="">
                            <h3>Faculty Initial (FIn)</h3>
                        </div>
                        <div class="rev_bars">
                            <div class="rev">
                                <h4>For Learning</h4>
                                <input type="range" min="1" max="100" value="0" id="learn_rev">
                            </div>
                            <div class="rev">
                                <h4>For Grading</h4>
                                <input type="range" min="1" max="100" value="0" id="grade_rev">
                            </div>
                        </div>
                    </div>
                    <div class="rev_opt">
                        <div class="fac_comment">
                            <i class="fa-regular fa-message"></i>
                        </div>
                        <div class="write_rev">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                </div>
                <div class="review_block">
                    <div class="main_rev">
                        <div class="fac_profile">
                            <img src="../image/no_profile_pic.jpg" alt="">
                            <h3>Faculty Initial (FIn)</h3>
                        </div>
                        <div class="rev_bars">
                            <div class="rev">
                                <h4>For Learning</h4>
                                <input type="range" min="1" max="100" value="0" id="learn_rev">
                            </div>
                            <div class="rev">
                                <h4>For Grading</h4>
                                <input type="range" min="1" max="100" value="0" id="grade_rev">
                            </div>
                        </div>
                    </div>
                    <div class="rev_opt">
                        <div class="fac_comment">
                            <i class="fa-regular fa-message"></i>
                        </div>
                        <div class="write_rev">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                </div>
                <div class="review_block">
                    <div class="main_rev">
                        <div class="fac_profile">
                            <img src="../image/no_profile_pic.jpg" alt="">
                            <h3>Faculty Initial (FIn)</h3>
                        </div>
                        <div class="rev_bars">
                            <div class="rev">
                                <h4>For Learning</h4>
                                <input type="range" min="1" max="100" value="0" id="learn_rev">
                            </div>
                            <div class="rev">
                                <h4>For Grading</h4>
                                <input type="range" min="1" max="100" value="0" id="grade_rev">
                            </div>
                        </div>
                    </div>
                    <div class="rev_opt">
                        <div class="fac_comment">
                            <i class="fa-regular fa-message"></i>
                        </div>
                        <div class="write_rev">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- comment modal -->
    <div id="comment_modal" class="modal">
        <div class="modal_content">
            <h2>Faculty Reviews</h2>
            <div class="comments_section">

                <div class="comment">
                    <div class="comment_header">
                        <img src="../image/no_profile_pic.jpg" alt="Profile Picture" class="profile_pic">
                        <div class="comment_info">
                            <h3>John Doe</h3>
                            <span class="comment_date">2024-11-07 14:30</span>
                        </div>
                    </div>
                    <p class="comment_text">This is a sample comment about the faculty. The faculty was very helpful and
                        the course was engaging.</p>
                    <div class="reviews">
                        <div class="rev">
                            <h4>Learning</h4>
                            <input type="range" value="70">
                        </div>
                        <div class="rev">
                            <h4>Grading</h4>
                            <input type="range" value="85">
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <div class="comment_header">
                        <img src="../image/no_profile_pic.jpg" alt="Profile Picture" class="profile_pic">
                        <div class="comment_info">
                            <h3>John Doe</h3>
                            <span class="comment_date">2024-11-07 14:30</span>
                        </div>
                    </div>
                    <p class="comment_text">This is a sample comment about the faculty. The faculty was very helpful and
                        the course was engaging.</p>
                    <div class="reviews">
                        <div class="rev">
                            <h4>Learning</h4>
                            <input type="range" value="70">
                        </div>
                        <div class="rev">
                            <h4>Grading</h4>
                            <input type="range" value="85">
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <div class="comment_header">
                        <img src="../image/no_profile_pic.jpg" alt="Profile Picture" class="profile_pic">
                        <div class="comment_info">
                            <h3>John Doe</h3>
                            <span class="comment_date">2024-11-07 14:30</span>
                        </div>
                    </div>
                    <p class="comment_text">This is a sample comment about the faculty. The faculty was very helpful and
                        the course was engaging.</p>
                    <div class="reviews">
                        <div class="rev">
                            <h4>Learning</h4>
                            <input type="range" value="70">
                        </div>
                        <div class="rev">
                            <h4>Grading</h4>
                            <input type="range" value="85">
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <div class="comment_header">
                        <img src="../image/no_profile_pic.jpg" alt="Profile Picture" class="profile_pic">
                        <div class="comment_info">
                            <h3>John Doe</h3>
                            <span class="comment_date">2024-11-07 14:30</span>
                        </div>
                    </div>
                    <p class="comment_text">This is a sample comment about the faculty. The faculty was very helpful and
                        the course was engaging.</p>
                    <div class="reviews">
                        <div class="rev">
                            <h4>Learning</h4>
                            <input type="range" value="70">
                        </div>
                        <div class="rev">
                            <h4>Grading</h4>
                            <input type="range" value="85">
                        </div>
                    </div>
                </div>
                <!-- Repeat .comment div for each comment -->
            </div>
        </div>
    </div>

    <!-- review modal -->
    <div id="review_modal" class="modal_review">
        <div class="modal_content">
            <h2>Write a Review</h2>

            <label class="anonymous_check">
                <input type="checkbox" id="anonymous" checked>
                Submit anonymously
            </label>

            <div class="review_section">
                <div class="rev_to_give">
                    <div style="display: flex; justify-content: space-between;">
                        <h4>For Learning</h4>
                        <h4 id="learn_rating" style="color: white;">0</h4>
                    </div>
                    <input type="range" min="1" max="10" value="0" id="learning_rate">
                </div>
                <div class="rev_to_give">
                    <div style="display: flex; justify-content: space-between;">
                        <h4>For Grading</h4>
                        <h4 id="grade_rating" style="color: white;">0</h4>
                    </div>
                    <input type="range" min="1" max="10" value="0" id="grading_rate">
                </div>
            </div>

            <label for="comment_text">Comment:</label>
            <?php
            echo file_get_contents("html/template/WFR_editor.html");
            ?>

            <div class="modal_buttons">
                <button id="cancel_button">Cancel</button>
                <button id="submit_button">Submit</button>
            </div>
        </div>
    </div>


    <!-- search box js -->
    <script>
        const courses = [
            "MAT101", "MAT102", "MAT201", "MAT202", "MAT301",
            "CSE110", "CSE120", "CSE210", "CSE220", "CSE310",
            "PHY111", "PHY112", "PHY211", "PHY212", "PHY311",
            "ENG102", "ENG103", "ENG202", "ENG203", "ENG302",
            "BIO105", "BIO106", "BIO205", "BIO206", "BIO305"
        ];
        const searchBox = document.querySelector(`#search_box_course`);
        const listContainer = document.querySelector(`#courseList`);

        function filterList() {
            const filter = searchBox.value.toLowerCase();

            listContainer.style.display = "block";
            listContainer.innerHTML = "";

            courses
                .filter(course => course.toLowerCase().includes(filter))
                .forEach(course => {
                    const option = document.createElement("div");
                    option.classList.add("dropdown-item");
                    option.textContent = course;
                    option.onclick = () => {
                        searchBox.value = course;
                        searchBox.style.color = '#ffffff'
                        listContainer.innerHTML = "";
                        listContainer.style.display = "none";
                    };
                    listContainer.appendChild(option);
                });
        }

        searchBox.addEventListener("focus", filterList);
        searchBox.addEventListener("input", filterList);

        document.addEventListener("click", (event) => {
            if (!searchBox.contains(event.target) && !listContainer.contains(event.target)) {
                listContainer.style.display = "none";
            }
        });
    </script>

    <!-- modal controll js -->
    <script>
        // Get modal elements
        const commentModal = document.getElementById('comment_modal');
        const facCommentButton = document.querySelector('.fac_comment');

        // Open modal when facCommentButton is clicked
        facCommentButton.addEventListener('click', () => {
            commentModal.style.display = 'flex';
        });

        // Close modal when clicking outside of the modal content
        window.addEventListener('click', (event) => {
            if (event.target === commentModal) {
                commentModal.style.display = 'none';
            }
        });

    </script>

    <script>
        document.getElementById('grading_rate').addEventListener("input", () => {
            document.getElementById('grade_rating').textContent = document.getElementById('grading_rate').value;
            document.getElementById('grading_rate').title = document.getElementById('grading_rate').value;
        });

        document.getElementById('learning_rate').addEventListener("input", () => {
            document.getElementById('learn_rating').textContent = document.getElementById('learning_rate').value;
            document.getElementById('learning_rate').title = document.getElementById('learning_rate').value;
        });

        // Elements
        const reviewModal = document.getElementById('review_modal');
        const revWriteButton = document.querySelector('.write_rev'); // Adjust if needed
        const cancelButton = document.getElementById('cancel_button');
        const submitButton = document.getElementById('submit_button');

        // Open modal
        revWriteButton.addEventListener('click', () => {
            reviewModal.style.display = 'flex';
        });

        // Close modal on 'Cancel' button
        cancelButton.addEventListener('click', () => {
            reviewModal.style.display = 'none';
        });

        // Close modal when clicking outside the modal content
        window.addEventListener('click', (event) => {
            if (event.target === reviewModal) {
                reviewModal.style.display = 'none';
            }
        });

        // Handle Submit button click (implement as needed)
        submitButton.addEventListener('click', () => {
            const isAnonymous = document.getElementById('anonymous').checked;
            const learningRating = document.getElementById('learning_rating').value;
            const gradingRating = document.getElementById('grading_rating').value;
            const commentText = document.getElementById('comment_text').value;

            // Logic to save the review (e.g., AJAX request)
            console.log({ isAnonymous, learningRating, gradingRating, commentText });

            // Close modal after submitting
            reviewModal.style.display = 'none';
        });

    </script>

</body>

</html>