<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/common.js"></script>
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            height: 100vh;
        }

        .container {
            height: calc(100vh - 60px);
            display: flex;
        }

        .main_body {
            background: #9595ff;
            width: -webkit-fill-available;
            border-radius: 10px;
            margin: 10px;
        }
    </style>

    <style>
        .review-container {
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #b8b8b8;
            background-color: #ffffff69;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        td .star-rating {
            width: auto;
            justify-content: center;
        }

        th {
            background-color: #333;
            color: #fff;
            font-weight: bold;
        }

        td button {
            background: linear-gradient(to right, #9428ff, #6a6aff, #00BCD4);
            background-size: 200% 100%;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: 0.5s;
        }

        td button:hover {
            background-position: 100% 0;
        }

        img {
            max-width: 50%;
            height: auto; 
        }

        
        .star-rating {
            display: flex;
            justify-content: start;
            margin-bottom: 10px;
            color: #FFD700;
            width: fit-content;
        }

        .star-rating span {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s;
        }

        .star-rating span.active {
            color: #FFD700;
        }

        .star-rating:hover span {
            color: #FFD700;
        }

        .star-rating span:hover~span {
            color: #ccc;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            color: #ff5d5d;
        }

        /* button {
            background: linear-gradient(to right, #ff2e00, #ff8d00, #ffd200);
            background-size: 200% 100%;
            animation: reverseHoverAnimation 0.5s ease forwards;
        }

        button:hover {
            animation: hoverAnimation 0.5s ease forwards;
        } */

        .modal-content-fr {
            background: linear-gradient(to right, #ffffff, #f3f4ff);
            /* margin: 10% auto; */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px 20px;
            width: 60%;
            position: absolute;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(58, 57, 57, 0.3);
            color: #333;
            height: fit-content;
            /* overflow-y: auto; */
        }

        .modal-content-fr h2 {
            margin-top: 0;
            color: #333;
            font-size: 24px;
            text-align: center;
            border-bottom: 2px solid #6a6aff;
            padding-bottom: 10px;
        }

        .modal-content-fr p {
            color: #666;
        }

        .modal-content-fr label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }

        textarea {
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            border: 1px solid #ccc;
            background: #ffffff69;
            font-size: 14px;
        }

        .sumbit_btn {
            background: linear-gradient(to right, #ff2e00, #ff8d00, #ffd200);
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 10px;
            width: 100%;
            margin-top: 20px;
            transition: 0.5s;
        }

        .sumbit_btn {
            background-position: 100% 0;
        }

        .close {
            color: #ff5d5d;
            font-size: 25px;
            position: absolute;
            right: 15px;
            top: 15px;
            cursor: pointer;
        }

        .close:hover {
            color: #ff2e00;
        }

        @keyframes reverseHoverAnimation {
            0% {
                background-position: 100% 0;
            }

            100% {
                background-position: 0 0;
            }
        }

        @keyframes hoverAnimation {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 100% 0;
            }
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
            <div class="review-container">
                <h1>Faculty Reviews</h1>
                <input type="text" id="searchBar" placeholder="Search by name or initials..." onkeyup="searchFaculty()">

                <table>
                    <thead>
                        <tr>
                            <th>Faculty Name</th>
                            <th>Initials</th>
                            <th>Overall Rating</th>
                            <th>Review!</th>
                        </tr>
                    </thead>
                    <tbody id="facultyTable">
                        <tr>
                            <td><button onclick="openFacultyModal('John Doe', 'JD', ' https://e7.pngegg.com/pngimages/653/612/png-clipart-lorem-ipsum-john-doe-digital-marketing-tincidunt-a-place-i-called-home-face-head-man-miscellaneous-hand.png', ['Math 101', 'CS 201'])">John Doe</button></td>
                            <td>JD</td>
                            <td><span class="star-rating">★★★★☆</span></td>
                            <td><button onclick="openReviewModal()">Make Review</button></td>
                        </tr>
                        <tr>
                            <td><button onclick="openFacultyModal('Professor Quirky', 'PQ', 'https://dreamlightvalleywiki.com/images/6/6f/Donald_Duck.png', ['History of Jellybeans', 'Quantum Sandwiches'])">Professor Quirky</button></td>
                            <td>PQ</td>
                            <td><span class="star-rating">★★★★★</span></td>
                            <td><button onclick="openReviewModal()">Make Review</button></td>
                        </tr>
                        <tr>
                            <td><button onclick="openFacultyModal('Dr. Fizzlebottom', 'FB', 'https://i1.sndcdn.com/avatars-ZkoiXGmhy64htgxE-ow17lw-t500x500.jpg', ['Advanced Nonsense', 'Bubble Physics'])">Dr. Fizzlebottom</button></td>
                            <td>FB</td>
                            <td><span class="star-rating">★★★☆☆</span></td>
                            <td><button onclick="openReviewModal()">Make Review</button></td>
                        </tr>
                        <tr>
                            <td><button onclick="openFacultyModal('Ms. Gigglepants', 'GP', 'https://example.com/giggle_image.jpg', ['Laughology 101', 'Comedy Chemistry'])">Ms. Gigglepants</button></td>
                            <td>GP</td>
                            <td><span class="star-rating">★★★★★</span></td>
                            <td><button onclick="openReviewModal()">Make Review</button></td>
                        </tr>
                        <tr>
                            <td><button onclick="openFacultyModal('Captain Cucumber', 'CC', 'https://example.com/cucumber_image.jpg', ['Vegetable Studies', 'Salsa Dancing'])">Captain Cucumber</button></td>
                            <td>CC</td>
                            <td><span class="star-rating">★★★★☆</span></td>
                            <td><button onclick="openReviewModal()">Make Review</button></td>
                        </tr>
                        <tr>
                            <td><button onclick="openFacultyModal('Duke of Donuts', 'DD', 'https://example.com/donut_image.jpg', ['Pastry Physics', 'Doughnut Dynamics'])">Duke of Donuts</button></td>
                            <td>DD</td>
                            <td><span class="star-rating">★★☆☆☆</span></td>
                            <td><button onclick="openReviewModal()">Make Review</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Review Modal -->
            <div id="reviewModal" class="modal">
                <div class="modal-content-fr">
                    <span class="close" onclick="closeReviewModal()">&times;</span>
                    <h2>Write a Review</h2>
                    <form>
                        <label for="reviewText">Review:</label>
                        <!-- <textarea id="reviewText" rows="4"></textarea> -->
                        <?php
                        echo readfile("WFR_editor.html");
                        ?>

                        <label>Learning:</label>
                        <div class="star-rating" id="learningRating">
                            <span onclick="setRating('learningRating', 1)">★</span>
                            <span onclick="setRating('learningRating', 2)">★</span>
                            <span onclick="setRating('learningRating', 3)">★</span>
                            <span onclick="setRating('learningRating', 4)">★</span>
                            <span onclick="setRating('learningRating', 5)">★</span>
                        </div>

                        <label>Grading:</label>
                        <div class="star-rating" id="gradingRating">
                            <span onclick="setRating('gradingRating', 1)">★</span>
                            <span onclick="setRating('gradingRating', 2)">★</span>
                            <span onclick="setRating('gradingRating', 3)">★</span>
                            <span onclick="setRating('gradingRating', 4)">★</span>
                            <span onclick="setRating('gradingRating', 5)">★</span>
                        </div>

                        <button class="sumbit_btn" type="submit">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Faculty Modal -->
            <div id="facultyModal" class="modal">
                <div class="modal-content-fr">
                    <span class="close" onclick="closeFacultyModal()">&times;</span>
                    <h2 id="facultyName">Faculty Name</h2>
                    <img id="facultyImage" src="#" alt="Faculty Image" loading="lazy"/>
                    <p><strong>Initials:</strong> <span id="facultyInitials"></span></p>
                    <p><strong>Courses:</strong> <span id="facultyCourses"></span></p>
                    <h3>Ratings</h3>
                    <div id="facultyRatings">
                        <p>Learning: ★★★★☆</p>
                        <p>Grading: ★★★☆☆</p>
                    </div>
                    <h3>Reviews</h3>
                    <div id="facultyReviews">
                        <p>No reviews yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openReviewModal() {
            document.getElementById("reviewModal").style.display = "block";
        }

        function closeReviewModal() {
            document.getElementById("reviewModal").style.display = "none";
        }

        function openFacultyModal(name, initials, imageUrl, courses) {
            document.getElementById("facultyName").innerText = name;
            document.getElementById("facultyInitials").innerText = initials;
            document.getElementById("facultyImage").src = imageUrl;
            document.getElementById("facultyCourses").innerText = courses.join(", ");
            document.getElementById("facultyModal").style.display = "block";
        }

        function closeFacultyModal() {
            document.getElementById("facultyModal").style.display = "none";
        }

        function setRating(id, rating) {
            const stars = document.getElementById(id).children;
            for (let i = 0; i < stars.length; i++) {
                stars[i].classList.remove("active");
            }
            for (let i = 0; i < rating; i++) {
                stars[i].classList.add("active");
            }
        }

        function searchFaculty() {
            const filter = document.getElementById("searchBar").value.toUpperCase();
            const rows = document.getElementById("facultyTable").getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const name = rows[i].getElementsByTagName("td")[0];
                const initials = rows[i].getElementsByTagName("td")[1];
                if (name || initials) {
                    const nameText = name.textContent || name.innerText;
                    const initialsText = initials.textContent || initials.innerText;
                    rows[i].style.display = (nameText.toUpperCase().indexOf(filter) > -1 || initialsText.toUpperCase().indexOf(filter) > -1) ? "" : "none";
                }
            }
        }

        window.onclick = function (event) {
            if (event.target == document.getElementById("reviewModal")) {
                closeReviewModal();
            }
            if (event.target == document.getElementById("facultyModal")) {
                closeFacultyModal();
            }
        }

    </script>
</body>

</html>