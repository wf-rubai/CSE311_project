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
            /* width: 50%; */
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
            <h3 style="margin: 0; color: white;">Saved Routines</h3>
            <div class="scroll_tab">
                <!-- added table_row div here from the hidden_routine_table based on database -->
            </div>
        </div>
    </div>


    <!-- hidden routine table html -->
    <div class="hidden_routine_table" hidden>
        <div class="table_row">
            <div class="routine">
                <div>
                    <button type="button" onclick="">Remove Table</button>
                    <button type="button" onclick="open_side_tab(this)">Routine detail</button>
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
                <button class="close" type="button" onclick="close_side_tab(this)">&times;</button>
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
                            <tr>
                                <td>CSE311</td>
                                <td>10</td>
                                <td>MW 10:40 AM - 12:05 PM</td>
                                <td>TBA</td>
                                <td>7</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- generative script -->
    <script>
        function new_tab() {
            return document.querySelector('.hidden_routine_table').innerHTML;
        }

        function open_side_tab(tag) {
            tag.parentElement.nextElementSibling.style.display = 'flex';
        }

        function close_side_tab(tag) {
            tag.parentElement.style.display = 'none';
        }
    </script>
</body>

</html>