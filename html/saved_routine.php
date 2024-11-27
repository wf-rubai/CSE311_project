<?php

$mysqli = connect();

checkLogin();

$sql = "SELECT * FROM save_routine WHERE user_id = ". $_SESSION['nsu_id'];
$routines = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        }

        .container {
            height: calc(100vh - 60px);
            display: flex;
        }

        .main_body {
            background: linear-gradient(to right, #32334d, #5a3e49);
            width: -webkit-fill-available;
            border-radius: 10px;
            margin: 10px;
            overflow: hidden;
            backdrop-filter: blur(15px);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .bg_img {
            position: absolute;
            opacity: .1;
            min-width: 100%;
            z-index: -1;
            top: 0;
            left: 0;
        }

        hr {
            width: 5px;
            background: white;
            border: 0;
            border-radius: 5px;
        }
    </style>
    <!-- base css -->
    <style>
        .scroll_tab {
            width: 100%;
            overflow-y: auto;
        }

        .table_row {
            display: flex;
            width: 100%;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            /* overflow-x: auto; */
        }
    </style>
    <!-- course table css -->
    <style>
        .course_tab {
            width: 550px;
            /* width: -webkit-fill-available; */
            height: fit-content;
            max-height: 280px;
            border-radius: 10px;
            overflow-y: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #33333380;
            margin: 0;
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

        .course_tab tr:hover td {
            background-color: #e8e8e880;
        }

        .course_tab table tbody tr td button {
            font-size: 20px;
            color: #ffb4b4;
            transition: .2s;
            background: 0;
            border: none;
            width: 100%;
        }

        .course_tab table tbody tr td button:hover {
            color: #ff0000f0;
        }
    </style>
    <!-- routine css -->
    <style>
        .routine {
            display: flex;
            flex-direction: column;
            align-items: end;
            transition: .5s;
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

        .routine div button,
        .close {
            margin: 0 2px 10px;
            padding: 5px;
            border: 1px solid #fff;
            background: 0;
            color: #fff;
            border-radius: 5px;
            transition: .3s;
        }

        .close {
            height: 20px;
            width: 20px;
            /* padding: 5px; */
            display: flex;
            align-items: center;
            border-radius: 50%;
            font-size: 15px;
            margin: 10px 2px;
        }

        .routine button:hover,
        .close:hover {
            color: #333;
            background-color: #fff;
            box-shadow: 0 0 10px 0 #fff;
        }
    </style>
</head>

<body>
    <!-- navigation bar -->
    <iframe src="template/nav_bar.html" style="border: none; width: 100%; height: 60px; display: block;"></iframe>

    <div class="container">
        <!-- side bar -->
        <iframe src="template/side_bar.html" class="side_bar" id="sidebar" style="border: none; width: 250px; margin: 10px 0 10px 10px; display: none;"></iframe>

        <!-- all main content here -->
        <div class="main_body">
            <img class="bg_img" src="../image/Slide1.jpg" alt="">
            <div class="scroll_tab">
                <h3 style="margin: 0; color: white; text-align: center;">Saved Routines</h3>
                <!-- added table_row div here from the hidden_routine_table based on database -->
            </div>
        </div>
    </div>


    <!-- hidden routine table html -->
    <div class="hidden_routine_table" hidden>
        <div class="table_row">
            <hr>
            <div class="routine">
                <div>
                    <button type="button" onclick="">Remove Table</button>
                    <button class="open" type="button" onclick="">Routine detail</button>
                </div>
                <table>
                    <tr data-rowNum="0">
                        <th></th>
                        <th>Sat</th>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                    </tr>
                    <tr data-rowNum="1">
                        <th>8:00 AM - 9:15 AM</th>
                        <td data-colNum="1"></td>
                        <td data-colNum="2"></td>
                        <td data-colNum="3"></td>
                        <td data-colNum="4"></td>
                        <td data-colNum="5"></td>
                        <td data-colNum="6"></td>
                    </tr>
                    <tr data-rowNum="2">
                        <th>9:25 AM - 10:40 AM</th>
                        <td data-colNum="1"></td>
                        <td data-colNum="2"></td>
                        <td data-colNum="3"></td>
                        <td data-colNum="4"></td>
                        <td data-colNum="5"></td>
                        <td data-colNum="6"></td>
                    </tr>
                    <tr data-rowNum="3">
                        <th>10:50 AM - 12:05 PM</th>
                        <td data-colNum="1"></td>
                        <td data-colNum="2"></td>
                        <td data-colNum="3"></td>
                        <td data-colNum="4"></td>
                        <td data-colNum="5"></td>
                        <td data-colNum="6"></td>
                    </tr>
                    <tr data-rowNum="4">
                        <th>12:15 PM - 1:30 PM</th>
                        <td data-colNum="1"></td>
                        <td data-colNum="2"></td>
                        <td data-colNum="3"></td>
                        <td data-colNum="4"></td>
                        <td data-colNum="5"></td>
                        <td data-colNum="6"></td>
                    </tr>
                    <tr data-rowNum="5">
                        <th>1:40 PM - 2:55 PM</th>
                        <td data-colNum="1"></td>
                        <td data-colNum="2"></td>
                        <td data-colNum="3"></td>
                        <td data-colNum="4"></td>
                        <td data-colNum="5"></td>
                        <td data-colNum="6"></td>
                    </tr>
                    <tr data-rowNum="6">
                        <th>3:05 PM - 4:20 PM</th>
                        <td data-colNum="1"></td>
                        <td data-colNum="2"></td>
                        <td data-colNum="3"></td>
                        <td data-colNum="4"></td>
                        <td data-colNum="5"></td>
                        <td data-colNum="6"></td>
                    </tr>
                    <tr data-rowNum="7">
                        <th>4:30 PM - 5:45 PM</th>
                        <td data-colNum="1"></td>
                        <td data-colNum="2"></td>
                        <td data-colNum="3"></td>
                        <td data-colNum="4"></td>
                        <td data-colNum="5"></td>
                        <td data-colNum="6"></td>
                    </tr>
                    <tr data-rowNum="8" hidden>
                        <th>5:55 - 7:10 PM</th>
                        <td data-colNum="1"></td>
                        <td data-colNum="2"></td>
                        <td data-colNum="3"></td>
                        <td data-colNum="4"></td>
                        <td data-colNum="5"></td>
                        <td data-colNum="6"></td>
                    </tr>
                </table>
            </div>
            <div style="display: none; flex-direction: column; align-items: end;">
                <button class="close" type="button" onclick="">&times;</button>
                <div class="course_tab">
                    <table>
                        <thead>
                            <tr>
                                <th style="border-radius: 10px 0 0 0;">Course</th>
                                <th style="border-radius: 0 0 0 0;">Section</th>
                                <th style="border-radius: 0 0 0 0;">Class Time</th>
                                <th style="border-radius: 0 0 0 0;">Faculty</th>
                                <th style="border-radius: 0 0 0 0;">Seat available</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- generative script -->
    <script>
        // const json_obj1 = [{
        //         "course": "CSE115",
        //         "row": "2",
        //         "col": "2",
        //         "section": "2",
        //         "time": "ST 9:25 AM - 10:40 AM",
        //         "faculty": "TBA",
        //         "seats": "24",
        //         "color": "rgb(0, 191, 255)"
        //     },
        //     {
        //         "course": "ACT201",
        //         "row": "2",
        //         "col": "3",
        //         "section": "1",
        //         "time": "MW 9:25 AM - 10:40 AM",
        //         "faculty": "TBA",
        //         "seats": "30",
        //         "color": "rgb(144, 238, 144)"
        //     },
        //     {
        //         "course": "CSE115",
        //         "row": "2",
        //         "col": "4",
        //         "section": "2",
        //         "time": "ST 9:25 AM - 10:40 AM",
        //         "faculty": "TBA",
        //         "seats": "24",
        //         "color": "rgb(0, 191, 255)"
        //     },
        //     {
        //         "course": "ACT201",
        //         "row": "2",
        //         "col": "5",
        //         "section": "1",
        //         "time": "MW 9:25 AM - 10:40 AM",
        //         "faculty": "TBA",
        //         "seats": "30",
        //         "color": "rgb(144, 238, 144)"
        //     },
        //     {
        //         "course": "CSE311L",
        //         "row": "5",
        //         "col": "1",
        //         "section": "6",
        //         "time": "A 1:40 PM - 4:20 PM",
        //         "faculty": "TBA",
        //         "seats": "7",
        //         "color": "rgb(144, 238, 144)"
        //     },
        //     {
        //         "course": "ACT202",
        //         "row": "5",
        //         "col": "2",
        //         "section": "5",
        //         "time": "ST 1:40 PM - 2:55 PM",
        //         "faculty": "TBA",
        //         "seats": "23",
        //         "color": "rgb(221, 160, 221)"
        //     },
        //     {
        //         "course": "ACT202",
        //         "row": "5",
        //         "col": "4",
        //         "section": "5",
        //         "time": "ST 1:40 PM - 2:55 PM",
        //         "faculty": "TBA",
        //         "seats": "23",
        //         "color": "rgb(221, 160, 221)"
        //     },
        //     {
        //         "course": "CSE311L",
        //         "row": "6",
        //         "col": "1",
        //         "section": "6",
        //         "time": "A 1:40 PM - 4:20 PM",
        //         "faculty": "TBA",
        //         "seats": "7",
        //         "color": "rgb(144, 238, 144)"
        //     }
        // ];
        // const json_obj2 = [{
        //         "course": "CSE115",
        //         "row": "1",
        //         "col": "3",
        //         "section": "1",
        //         "time": "MW 8:00 AM - 9:15 AM",
        //         "faculty": "TBA",
        //         "seats": "3",
        //         "color": "rgb(218, 218, 0)"
        //     },
        //     {
        //         "course": "CSE115",
        //         "row": "1",
        //         "col": "5",
        //         "section": "1",
        //         "time": "MW 8:00 AM - 9:15 AM",
        //         "faculty": "TBA",
        //         "seats": "3",
        //         "color": "rgb(218, 218, 0)"
        //     },
        //     {
        //         "course": "MAT116",
        //         "row": "3",
        //         "col": "3",
        //         "section": "9",
        //         "time": "MW 10:50 AM - 12:05 PM",
        //         "faculty": "TBA",
        //         "seats": "34",
        //         "color": "rgb(144, 238, 144)"
        //     },
        //     {
        //         "course": "MAT116",
        //         "row": "3",
        //         "col": "5",
        //         "section": "9",
        //         "time": "MW 10:50 AM - 12:05 PM",
        //         "faculty": "TBA",
        //         "seats": "34",
        //         "color": "rgb(144, 238, 144)"
        //     },
        //     {
        //         "course": "PHY107L",
        //         "row": "3",
        //         "col": "6",
        //         "section": "3",
        //         "time": "R 10:50 AM - 1:30 PM",
        //         "faculty": "TBA",
        //         "seats": "28",
        //         "color": "rgb(255, 182, 193)"
        //     },
        //     {
        //         "course": "PHY107L",
        //         "row": "4",
        //         "col": "6",
        //         "section": "3",
        //         "time": "R 10:50 AM - 1:30 PM",
        //         "faculty": "TBA",
        //         "seats": "28",
        //         "color": "rgb(255, 182, 193)"
        //     },
        //     {
        //         "course": "EEE154",
        //         "row": "5",
        //         "col": "1",
        //         "section": "2",
        //         "time": "A 1:40 PM - 2:55 PM",
        //         "faculty": "TBA",
        //         "seats": "0",
        //         "color": "rgb(144, 238, 144)"
        //     },
        //     {
        //         "course": "HIS103",
        //         "row": "5",
        //         "col": "2",
        //         "section": "15",
        //         "time": "ST 1:40 PM - 2:55 PM",
        //         "faculty": "TBA",
        //         "seats": "4",
        //         "color": "rgb(0, 191, 255)"
        //     },
        //     {
        //         "course": "HIS103",
        //         "row": "5",
        //         "col": "4",
        //         "section": "15",
        //         "time": "ST 1:40 PM - 2:55 PM",
        //         "faculty": "TBA",
        //         "seats": "4",
        //         "color": "rgb(0, 191, 255)"
        //     }
        // ]

        function new_tab_row() {
            return document.querySelector('.hidden_routine_table .table_row').cloneNode(true);
        }

        function open_side_tab(tag) {
            tag.parentElement.parentElement.nextElementSibling.style.display = 'flex';
        }

        function close_side_tab(tag) {
            tag.parentElement.style.display = 'none';
        }
    </script>

    <!-- set table js -->
    <script>
        // generate_table(json_obj1);
        // generate_table(json_obj2);
        // generate_table(json_obj1);
        // generate_table(json_obj2);
        
        <?php
        while($routine = $routines->fetch_assoc()) {
            echo "generate_table(". $routine['table_id'] .",".  $routine['routine_data'] .");";
        }
        ?>

        function generate_table(table_id, json) {
            let new_tab = new_tab_row();
            json.forEach(obj => {
                set_routine(obj, new_tab);
            });
            set_table(json, new_tab);

            new_tab.querySelector('.open').onclick = function() {
                open_side_tab(this);
            };
            new_tab.querySelector('.close').onclick = function() {
                close_side_tab(this);
            };
            document.querySelector('.scroll_tab').appendChild(new_tab);
        }

        function set_routine(obj, tab) {
            let rows = tab.querySelectorAll('.routine table tr');
            rows.forEach(row => {
                if (row.dataset.rownum === obj.row) {
                    let row_td = row.querySelectorAll('td');
                    row_td.forEach(td => {
                        if (td.dataset.colnum === obj.col) {
                            td.innerText = obj.course;
                            td.style.backgroundColor = obj.color;
                        }
                    });
                }
            });
        }

        function set_table(obj, tab) {
            let rows = remove_duplicate_courses(obj);
            let table = tab.querySelector('.course_tab table tbody');
            rows.forEach(row => {
                let newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${row.course}</td>
                    <td>${row.section}</td>
                    <td>${row.time}</td>
                    <td>${row.faculty}</td>
                    <td>${row.seats}</td>
                `;
                table.appendChild(newRow);
            });
        }

        function remove_duplicate_courses(jsonArray) {
            const uniqueCourses = new Map();
            jsonArray.forEach(obj => {
                if (!uniqueCourses.has(obj.course)) {
                    uniqueCourses.set(obj.course, obj);
                }
            });
            return Array.from(uniqueCourses.values());
        }
    </script>
</body>

</html>