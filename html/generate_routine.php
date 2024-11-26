<?php
$conn = connect();

$a_2 = 'SELECT c.course FROM courses c GROUP BY c.course';
$result_2 = $conn->query($a_2);
$_course_ = '';
while ($r = $result_2->fetch_assoc()) {
    $_course_ .= "'" . $r['course'] . "',";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/common.js"></script>
    <title>Document</title>
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
            overflow: hidden;
        }

        .container {
            /* background-color: #41ff51; */
            height: calc(100vh - 60px);
            display: flex;
        }

        .main_body {
            /* background: #9595ff; */
            width: -webkit-fill-available;
            border-radius: 10px;
            margin: 10px;
            overflow-y: auto;
        }
    </style>

    <!-- info_dec css -->
    <style>
        .info_dec {
            /* background: #e9e9e9; */
            background-image: url(https://images.pexels.com/photos/7130560/pexels-photo-7130560.jpeg?cs=srgb&dl=pexels-codioful-7130560.jpg&fm=jpg);
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            border-radius: 10px;
            padding: 20px;
            color: #333;
        }

        .info_dec button {
            width: 150px;
            border: oldlace;
            border-radius: 5px;
            padding: 5px;
            margin: 10px;
        }

        #addCourse {
            background: linear-gradient(to right, #9428ff, #6a6aff, #00BCD4);
            background-size: 200% 100%;
            animation: reverseHoverAnimation .5s ease forwards;
            margin-left: 0;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        @keyframes reverseHoverAnimation {
            0% {
                background-position: 100% 0%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        @keyframes hoverAnimation {
            0% {
                background-position: 0% 0%;
            }

            100% {
                background-position: 100% 0%;
            }
        }

        #addCourse:hover {
            animation: hoverAnimation .5s ease forwards;
        }


        #generateRoutine {
            background: linear-gradient(to right, #ff2e00, #ff8d00, #ffd200);
            background-size: 200% 100%;
            animation: reverseHoverAnimation .5s ease forwards;
            margin-left: 0;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        #generateRoutine:hover {
            animation: hoverAnimation .5s ease forwards;
        }

        .info_group {
            padding: 10px 0;
            display: flex;
            align-items: center;
        }

        .info_group label {
            width: 160px;
        }

        .info_group input[type='number'],
        input[type='search'],
        select {
            /* width: 300px; */
            width: 43%;
            padding: 5px;
            border: 1px solid #b8b8b8;
            border-radius: 5px;
            background-color: #ffffff69;
        }

        .info_group select {
            cursor: pointer;
        }

        .dropdown-list,
        .dropdown-list-color {
            display: none;
            border: 1px solid #b8b8b8;
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

        .custom-dropdown {
            position: relative;
            display: inline-block;
            width: 200px;
        }

        .selected_option {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            background-color: #ffffff69;
            font-size: 13px;
        }

        .dlt_course {
            /* background: white; */
            background-color: #ffffff69;
            color: #ff5d5d;
            height: 25px;
            width: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            margin-left: 50px;
            scale: .7;
            font-size: 25px;
            cursor: pointer;
        }

        .dlt_course:hover {
            color: white;
            background: #ff5d5d;
        }
    </style>

    <!-- show_table css -->
    <style>
        .show_table {
            background-image: url(https://images.pexels.com/photos/7130475/pexels-photo-7130475.jpeg?cs=srgb&dl=pexels-codioful-7130475.jpg&fm=jpg);
            background-size: cover;
            background-position: center;
            /* background: #cfcfcf; */
            /* background-image: linear-gradient(135deg, #949494, #555555); */
            margin-top: 10px;
            padding: 20px;
            border-radius: 10px;
            color: white;
            display: none;
            flex-direction: column;
            align-items: center;
        }

        .time_table {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        .routine table {
            /* width: 100%; */
            border-collapse: separate;
            font-family: Arial, sans-serif;
            font-size: 14px;
            border-spacing: 2.5px;
            /* display: none; */
        }

        .routine th,
        .routine td {
            padding: 10px;
            /* border: 1px solid #ddd; */
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
        }

        .routine th {
            background-color: #333;
            color: #ffffff;
        }

        .routine th:first-child {
            background-color: #555;
            font-weight: bold;
            width: fit-content;
            /* display: none; */
        }

        .routine td {
            background-color: #f9f9f9;
            width: 100px;
        }

        .tab_compare {
            display: flex;
            justify-content: flex-end;
        }

        .tab_compare button {
            background: linear-gradient(to right, #4CAF50, #CDDC39, #f48b36);
            background-size: 200% 100%;
            animation: reverseHoverAnimation .5s ease forwards;
            margin: 10px 0;
            padding: 10px 20px;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .tab_compare button:hover {
            animation: hoverAnimation .5s ease forwards;
        }

        .tab_swap_controll {
            margin: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tab_swap_controll button,
        .close_course_detail {
            margin: 0 10px;
            border: 0;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            font-size: 12px;
            align-items: center;
            background: #ffffff45;
            color: white;
            transition: .5s;
            cursor: pointer;
        }

        .tab_swap_controll button:hover,
        .close_course_detail:hover {
            background: #ffffff6e;
            box-shadow: 0 0 10px 2px #fff;
        }

        .close_course_detail {
            margin: 0 0 10px 0;
        }

        .course_detail {
            flex-grow: 1;
            margin: 10px 0 10px 10px;
            display: none;
            flex-direction: column;
            align-items: flex-end;
            /* flex-grow: 1; */
        }

        .details_table {
            /* width: 100%; */
            width: -webkit-fill-available;
            /* height: -webkit-fill-available; */
            height: fit-content;
            background: #ffffff45;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .dt {
            margin-bottom: 10px;
        }

        .course_tab table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .course_tab th,
        .course_tab td {
            padding: 10px;
            text-align: center;
        }

        .course_tab th {
            background-color: #33333340;
            color: #ffffff;
            font-weight: bold;
            position: sticky;
            top: 0;
            backdrop-filter: blur(10px);
        }

        .course_tab td {
            background-color: #ffffff40;
            color: #000000;
            border-top: .5px solid #5f5f5f;
        }

        /* .course_tab tr:nth-child(even) td {
            background-color: #eeeeee80;
        } */

        .course_tab tr:hover td {
            background-color: #e8e8e880;
        }

        .course_tab {
            max-height: 200px;
            border-radius: 10px;
            overflow-y: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #33333380;
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

        <div class="main_body">
            <div class="info_dec">
                <h3 style="text-align: center; margin-top: 0;">Your Advising Preferences</h3>

                <div style="display: flex;">
                    <div class="info_group">
                        <label for="max_cr">Maximum credit</label>
                        <input type="number" id="max_cr" value="10" required>
                    </div>
                    <div class="info_group" style="margin-left: 50px;">
                        <label for="min_cr">Minimum credit</label>
                        <input type="number" id="min_cr" value="6" required>
                    </div>
                </div>
                <div class="info_group">
                    <label for="min_cr_6">Minimum class days</label>
                    <div style="display: flex; align-items: center;">
                        <input type="radio" id="min_cr_6" name="min_cr" value="6" style="margin: 0 5px 0 0;" checked>
                        <label for="min_cr_6" style="margin-right: 30px; width: 0;">6</label>
                        <input type="radio" id="min_cr_4" name="min_cr" value="4" style="margin: 0 5px 0 0;">
                        <label for="min_cr_4" style="margin-right: 30px; width: 0;">4</label>
                        <input type="radio" id="min_cr_2" name="min_cr" value="2" style="margin: 0 5px 0 0;">
                        <label for="min_cr_2" style="margin-right: 30px; width: 0;">2</label>
                    </div>
                </div>
                <div class="selected_courses">
                </div>

                <div style="display: flex; justify-content: flex-start;">
                    <button type="button" id="addCourse">+ Add course</button>
                    <button type="submit" id="generateRoutine">Generate Routine</button>
                </div>
            </div>

            <div class="show_table">
                <h3 style="text-align: center; margin-top: 0;">
                    Class Time Tables
                </h3>
                <div class="time_table">
                    <div class="routine">
                        <!-- <div class="tab_compare">
                            <button class="tab_compare">+ Add to compare</button>
                        </div> -->
                        <div class="rout_table_container">
                        </div>
                        <div class="tab_swap_controll">
                            <button class="prev_tab"><i class="fa fa-chevron-left"></i></button>
                            <span class="current_tab">7</span>
                            <span style="margin: 0 3px;">|</span>
                            <span class="total_tab">39</span>
                            <button class="next_tab"><i class="fa fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <div class="course_detail">
                        <div class="close_course_detail">&times;</div>
                        <div class="details_table">
                            <div>
                                <div class="dt" style="display: flex;">
                                    <div style="width: 40%;" class="dt1">Course Title</div>
                                    <div style="width: 10%;" class="dt2">:</div>
                                    <div style="width: 50%;" class="dt3">CSE311L</div>
                                </div>
                                <div class="dt" style="display: flex;">
                                    <div style="width: 40%;" class="dt1">Course Credit</div>
                                    <div style="width: 10%;" class="dt2">:</div>
                                    <div style="width: 50%;" class="dt3">1</div>
                                </div>
                                <div class="dt" style="display: flex;">
                                    <div style="width: 40%;" class="dt1">Class Time</div>
                                    <div style="width: 10%;" class="dt2">:</div>
                                    <div style="width: 50%;" class="dt3">8:00 AM - 9:15 AM</div>
                                </div>
                                <div class="dt" style="display: flex;">
                                    <div style="width: 40%;" class="dt1">Class Day</div>
                                    <div style="width: 10%;" class="dt2">:</div>
                                    <div style="width: 50%;" class="dt3">RA</div>
                                </div>
                            </div>
                            <div class="course_tab">
                                <table>
                                    <tr>
                                        <th style="border-radius: 10px 0 0 0;">Section</th>
                                        <th style="border-radius: 0 0 0 0;">Faculty</th>
                                        <th style="border-radius: 0 0 0 0;">Room</th>
                                        <th style="border-radius: 0 10px 0 0;">Seats available</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>TBA</td>
                                        <td>SAC308</td>
                                        <td>20</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>TBA</td>
                                        <td>NAC211</td>
                                        <td>20</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>TBA</td>
                                        <td>SAC306</td>
                                        <td>20</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- routine table supply div  -->
    <div class="rout_table_container_supply" hidden>
        <table>
            <tr>
                <th></th>
                <th>Sat</th>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
            </tr>
            <tr>
                <th>8:00 AM - 9:15 AM</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>9:25 AM - 10:40 AM</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>10:50 AM - 12:05 PM</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>12:15 PM - 1:30 PM</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>1:40 PM - 2:55 PM</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>3:05 PM - 4:20 PM</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>4:30 PM - 5:45 PM</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr hidden>
                <th>5:55 - 7:10 PM</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

    <!-- new course list supply  -->
    <div class="course_selection_supply">
        <div class="info_group course_selection" style="display: flex;">
            <label for="search_box_course">Choose course</label>
            <div style="width: 300px; position: relative;">
                <input style="width: 312px;" type="search" class="search_box_course" id="search_box_course" placeholder="Course title"
                    onfocus="filterList()" required>
                <div id="courseList" class="dropdown-list"></div>
            </div>
            <label style="margin-left: 50px; width: 60px;position: relative; left: 12px; ">Credit</label>
            <select name="credit" style="width: 200px;" required>
                <option value="1">1</option>
                <option value="1.5">1.5</option>
                <option value="3" selected>3</option>
            </select>
            <label style="margin-left: 50px; width: 60px;">Color</label>
            <div class="custom-dropdown">
                <div class="selected_option" id="selectedColor">
                    <i class="fa fa-square" style="color: rgb(95, 95, 255);"></i> Blue
                </div>
                <div class="dropdown-list-color" id="colorList" style="width: calc(100% - 12px);">
                    <div class="dropdown-item" data-color="red">
                        <i class="fa fa-square" style="color: rgb(255, 99, 99); margin-right: 5px;"></i> Red
                    </div>
                    <div class="dropdown-item" data-color="green">
                        <i class="fa fa-square" style="color: rgb(91, 255, 91); margin-right: 5px;"></i>
                        Green
                    </div>
                    <div class="dropdown-item" data-color="blue">
                        <i class="fa fa-square" style="color: rgb(95, 95, 255); margin-right: 5px;"></i>
                        Blue
                    </div>
                    <div class="dropdown-item" data-color="yellow">
                        <i class="fa fa-square" style="color: rgb(218, 218, 0); margin-right: 5px;"></i>
                        Yellow
                    </div>
                    <div class="dropdown-item" data-color="orange">
                        <i class="fa fa-square" style="color: rgb(255, 166, 0); margin-right: 5px;"></i>
                        Orange
                    </div>
                    <div class="dropdown-item" data-color="purple">
                        <i class="fa fa-square" style="color: rgb(255, 93, 255); margin-right: 5px;"></i>
                        Pink
                    </div>
                    <div class="dropdown-item" data-color="purple">
                        <i class="fa fa-square" style="color: rgb(0, 255, 255); margin-right: 5px;"></i>
                        Cyan
                    </div>
                    <div class="dropdown-item" data-color="purple">
                        <i class="fa fa-square" style="color: rgb(188, 188, 188); margin-right: 5px;"></i>
                        Gray
                    </div>
                </div>
            </div>
            <div class="dlt_course">&times;</div>
        </div>
    </div>

    <!-- show_table div related js -->
    <script>
        let currentIndex = 1;
        let totalRoutine = 1;
        let routine_combination_list = {};

        function open_side_tab(course, time) {
            // alert shoray tui tr kaj kor
            // for arman
            alert(course, time);
            document.querySelector(".course_detail").style.display = "flex";
        }
        document.querySelector(".close_course_detail").addEventListener('click', () => {
            document.querySelector(".course_detail").style.display = "none";
        });


        document.getElementById("generateRoutine").addEventListener('click', () => {
            let courses = document.querySelectorAll('.selected_courses .course_selection');
            let course_list = [];
            courses.forEach(course => {
                let record = {
                    course: course.querySelector('.search_box_course').value,
                    cr: course.querySelector('select[name="credit"]').value,
                    color: course.querySelector('.selected_option i').style.color
                }
                course_list.push(record);
            });
            let record = {
                min_cr: document.getElementById('min_cr').value,
                max_cr: document.getElementById('max_cr').value,
                day_num: document.querySelector('input[name="min_cr"]:checked').value
            }
            course_list.push(record);
            // console.log(course_list);
            fetch('/generatingAlgorithm', {
                    method: 'POST',
                    body: JSON.stringify({
                        courses: course_list
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(routines => routines.json()) // Change 'response' to 'routines' here
                .then(data => {
                    initiate_routine_display(data);
                    console.log(routine_combination_list[1]);
                    new_table(routine_combination_list[1]);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            document.querySelector(".show_table").style.display = "flex";
        });
        document.querySelector(".prev_tab").addEventListener('click', function() {
            if (currentIndex > 1) {
                currentIndex -= 1;
                new_table(routine_combination_list[currentIndex]);
            }
            document.querySelector(".current_tab").textContent = currentIndex;
        });
        document.querySelector(".next_tab").addEventListener('click', function() {
            if (currentIndex < totalRoutine) {
                currentIndex += 1;
                new_table(routine_combination_list[currentIndex]);
            }
            document.querySelector(".current_tab").textContent = currentIndex;
        });

        function initiate_routine_display(data) {
            routine_combination_list = {};
            data.forEach((routine) => {
                routine_combination_list[routine.table] = routine.routine;
            });
            totalRoutine = Object.keys(routine_combination_list).length;
            currentIndex = 1;
            document.querySelector(".current_tab").textContent = currentIndex;
            document.querySelector(".total_tab").textContent = totalRoutine;
        }
    </script>

    <!-- Adds a row to insert course info -->
    <script>
        const courses = [<?php echo $_course_; ?>];
        // const courses = [
        //     "MAT101", "MAT102", "MAT201", "MAT202", "MAT301",
        //     "CSE110", "CSE120", "CSE210", "CSE220", "CSE310",
        //     "PHY111", "PHY112", "PHY211", "PHY212", "PHY311",
        //     "ENG102", "ENG103", "ENG202", "ENG203", "ENG302",
        //     "BIO105", "BIO106", "BIO205", "BIO206", "BIO305"
        // ];


        document.getElementById("addCourse").addEventListener("click", () => {
            const originalCourseSelection = document.querySelector(".course_selection_supply .course_selection");
            const newCourseSelection = originalCourseSelection.cloneNode(true);

            newCourseSelection.querySelector("#search_box_course").value = "";
            newCourseSelection.querySelector("#selectedColor").innerHTML = "<i class=\"fa fa-square\" style=\"color: rgb(95, 95, 255);\"></i> Blue";

            const uniqueID = Date.now();
            newCourseSelection.querySelector("#search_box_course").id = `search_box_course_${uniqueID}`;
            newCourseSelection.querySelector("#courseList").id = `courseList_${uniqueID}`;
            newCourseSelection.querySelector("#selectedColor").id = `selectedColor_${uniqueID}`;
            newCourseSelection.querySelector("#colorList").id = `colorList_${uniqueID}`;

            newCourseSelection.style.display = 'flex';
            document.querySelector(".selected_courses").appendChild(newCourseSelection);

            // Color dropdown 
            const selectedColor = newCourseSelection.querySelector(`#selectedColor_${uniqueID}`);
            const colorList = newCourseSelection.querySelector(`#colorList_${uniqueID}`);

            selectedColor.addEventListener("click", () => {
                colorList.style.display = colorList.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", (event) => {
                if (!selectedColor.contains(event.target) && !colorList.contains(event.target)) {
                    colorList.style.display = "none";
                }
            });

            colorList.addEventListener("click", (event) => {
                if (event.target.classList.contains("dropdown-item")) {
                    selectedColor.innerHTML = event.target.innerHTML;
                    selectedColor.querySelector("i").style.marginRight = "0";
                    selectedColor.style.color = 'black';
                    colorList.style.display = "none";
                }
            });

            // Course list dropdown 
            const searchBox = newCourseSelection.querySelector(`#search_box_course_${uniqueID}`);
            const listContainer = newCourseSelection.querySelector(`#courseList_${uniqueID}`);

            window.filterList = function() {
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

            // delete course button action
            const deleteIcon = newCourseSelection.querySelector(".dlt_course");

            deleteIcon.addEventListener("click", () => {
                newCourseSelection.remove();
            });
        });
    </script>

    <!-- generation start here -->
    <script>
        function new_table(course_list) {
            let new_tab = document.querySelector('.rout_table_container_supply table').cloneNode(true);
            course_list.forEach(cour => {
                set_course(cour, new_tab);
            });
            document.querySelector('.rout_table_container').innerHTML = '';
            document.querySelector('.rout_table_container').appendChild(new_tab);
        }

        function set_course(course, tab) {
            const regex = /([STMWRAstmwra]{1,2}) (\d{1,2}:\d{2} [APM]{2} - \d{1,2}:\d{2} [APM]{2})/;
            let day_time = course.time.match(regex);
            let days = day_time[1];
            let time = day_time[2];

            const daysMapping = {
                'A': 1, // Saturday
                'S': 2, // Sunday
                'M': 3, // Monday
                'T': 4, // Tuesday
                'W': 5, // Wednesday
                'R': 6 // Thursday
            };

            // Loop through each day in days (e.g., 'MW' -> Monday, Wednesday)
            for (let day of days) {
                const dayColumn = daysMapping[day];
                if (dayColumn) {
                    // Locate the correct row by matching the time
                    const rows = tab.querySelectorAll("tr");

                    rows.forEach((row) => {
                        const timeCell = row.querySelector("th");
                        if (normalizeTime(timeCell.textContent.trim()) != '') {
                            if (timesIntersect(normalizeTime(timeCell.textContent.trim()), normalizeTime(time.trim()))) {
                                const targetCell = row.cells[dayColumn];
                                if (targetCell) {
                                    targetCell.style.backgroundColor = course.color;
                                    targetCell.textContent = course.course;
                                    targetCell.dataset.time = course.time;
                                    targetCell.onclick = function() {
                                        open_side_tab(course.course, course.time);
                                    };

                                } else {
                                    console.warn(`No cell found for day ${day} and time ${time}`);
                                }
                            }
                        }
                    });
                }
            }
        }

        function timesIntersect(period1, period2) {
            if (period1 === period2) {
                return true;
            }
            // Helper function to convert 12-hour time format (HH:MM AM/PM) to minutes
            const timeToMinutes = (time) => {
                const [timePart, period] = time.split(' '); // Split time and AM/PM
                let [hours, minutes] = timePart.split(':').map(Number); // Split hours and minutes
                if (period === 'PM' && hours !== 12) hours += 12; // Convert PM times
                if (period === 'AM' && hours === 12) hours = 0; // Convert 12 AM to 00:00
                return hours * 60 + minutes;
            };

            // Extract start and end times from each period
            const extractTimes = (period) => {
                const [startTime, endTime] = period.split(' - '); // Split the period into start and end times
                return {
                    start: timeToMinutes(startTime.trim()),
                    end: timeToMinutes(endTime.trim())
                };
            };

            // Extract start and end times for both periods
            const {
                start: startTime1,
                end: endTime1
            } = extractTimes(period1);
            const {
                start: startTime2,
                end: endTime2
            } = extractTimes(period2);

            // Check if the two time periods overlap
            return startTime1 < endTime2 && startTime2 < endTime1;
        }

        function normalizeTime(timeString) {
            return timeString.replace(/\b0(\d)/g, '$1'); // Remove leading zeros from hours
        }
    </script>
</body>

</html>