<?php
$conn = connect();

checkLogin();
$nsu_id = $_SESSION['nsu_id'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['save_routine'])) {
        header('Content-Type: application/json');
        $routine_data = $_POST['jsondata'];

        try {
            $sql = "INSERT INTO save_routine (user_id, routine_data) VALUES ($nsu_id, '$routine_data')";
            $conn->query($sql);
            echo json_encode(['message' => 'success', 'redirectUrl' => '/custom_routine']);
        } catch (exception $e) {
            echo json_encode(['message' => 'Error! Could not save your routine!']);
        }
        exit();
    }
}

$a_2 = 'SELECT c.course FROM courses c GROUP BY c.course';
$result_2 = $conn->query($a_2);
$_course_ = '';
while ($r = $result_2->fetch_assoc()) {
    $_course_ .= "'" . $r['course'] . "',";
}

$a_1 = 'SELECT course, section, CONCAT(days, " ", start, " - ", end) as time, faculty, seats FROM courses';
$result_1 = $conn->query($a_1);
$_sections = '';
while ($r = $result_1->fetch_assoc()) {
    $_sections .= '{"course":"' . $r['course'] . '","section":"' . $r['section'] . '","time":"' . $r['time'] . '","faculty":"' . $r['faculty'] . '","seats":"' . $r['seats'] . '"},';
}
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
            background-color: #ffffff;
            height: calc(100vh - 60px);
            display: flex;
        }

        .main_body {
            /* background: #9595ff; */
            background: linear-gradient(to right, #32334d, #5a3e49);
            width: -webkit-fill-available;
            border-radius: 10px;
            margin: 10px;
            overflow: hidden;
            backdrop-filter: blur(15px);
        }

        .bg_img {
            position: absolute;
            opacity: .1;
            min-width: 100%;
            z-index: -1;
        }

        .course_selection,
        .routine_table {
            height: 50%;
            /* background: #32334d; */
            /* border: 2px solid; */
        }
    </style>
    <!-- dropdown search box css -->
    <style>
        .search_field {
            margin: 10px 0 0 0;
        }

        .search_field input {
            width: 43%;
            padding: 5px;
            border: 1.5px solid #ffffff80;
            border-radius: 5px;
            background-color: #ffffff90;
        }

        #courseList,
        #sectionList {
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

        #sectionList .dropdown-item {
            display: flex;
        }

        .dropdown-item {
            padding: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            border-radius: 5px;
        }

        .dropdown-item:hover {
            background-color: #518eff;
            border-radius: 5px;
        }
    </style>
    <!-- course_selection css -->
    <style>
        .course_selection {
            padding: 20px;
            color: white;
        }

        .input_div {
            margin: 20px 0 0 0;
        }

        .select_courss_info button {
            margin: 20px 0 0 0;
            padding: 5px;
            width: 75px;
            background: 0;
            border: 1.5px solid #fff;
            border-radius: 5px;
            color: white;
            transition: .5s;
        }

        .select_courss_info button:hover {
            box-shadow: 0 0 10px 2px #fff;
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

        .course_tab {
            width: -webkit-fill-available;
            height: fit-content;
            max-height: 280px;
            border-radius: 10px;
            overflow-y: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #33333380;
            margin: 20px 0 0 0;
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
    <!-- routine_table css -->
    <style>
        .routine_table {
            display: flex;
            justify-content: center;
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

        .tab_swap_controll {
            margin: 10px 3px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .tab_swap_controll button {
            margin: 0 0 0 10px;
            border: 0;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            font-size: 15px;
            align-items: center;
            background: 0;
            color: #ffffff;
            cursor: pointer;
            padding: 5px;
            border: 1px solid #fff;
            transition: .5s;
        }

        .tab_swap_controll button:hover {
            background: #ffffff;
            color: #333;
            box-shadow: 0 0 10px #fff;
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
            <div class="course_selection">
                <h3 style="text-align: center; margin-top: 0;">Create Routine</h3>
                <div style="display: flex; gap: 20px; height: -webkit-fill-available;">
                    <div class="select_courss_info">
                        <div class="input_div">
                            <label for="search_box_course">Choose Course</label>
                            <div class="search_field">
                                <div style="width: 300px; position: relative;">
                                    <input style="width: 100%;" type="search" id="search_box_course"
                                        placeholder="Course title" onfocus="filterList()" required>
                                    <div id="courseList" class="dropdown-list"></div>
                                </div>
                            </div>
                        </div>
                        <div class="input_div">
                            <label for="course_title">Choose Section or Time</label>
                            <div class="search_field">
                                <div style="width: 300px; position: relative;">
                                    <input style="width: 100%;" type="search" id="search_box_section"
                                        placeholder="Section and time" onfocus="filterSectionList()" required>
                                    <div id="sectionList" class="dropdown-list-section dropdown-list"></div>
                                </div>
                            </div>
                        </div>
                        <button id="addButton">Add</button>
                    </div>
                    <div class="course_tab">
                        <table>
                            <thead>
                                <tr>
                                    <th style="border-radius: 10px 0 0 0;">Course</th>
                                    <th style="border-radius: 0 0 0 0;">Section</th>
                                    <th style="border-radius: 0 0 0 0;">Class Time</th>
                                    <th style="border-radius: 0 0 0 0;">Faculty</th>
                                    <th style="border-radius: 0 0 0 0;">Seat available</th>
                                    <th style="border-radius: 0 10px 0 0;">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <form method="POST">
                <div class="routine_table">
                    <div class="routine">
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
                        </table>
                        <div class="tab_swap_controll">
                            <button class="prev_tab" onclick="cleanAll()" title="Delete routine">Clear</button>
                            <button type="button" class="next_tab" onclick="saveRoutine()" title="Save routine">Save Routine</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- course selection js -->
    <script>
        const courses = [<?php echo $_course_; ?>];
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

    <!-- section selection js -->
    <script>
        const sections = [<?php echo $_sections; ?>];
        let short_section = [];

        const sectionSearchBox = document.querySelector(`#search_box_section`);
        const sectionListContainer = document.querySelector(`#sectionList`);

        function filterSectionList() {
            short_section = [];
            const filter = sectionSearchBox.value.toLowerCase();
            const selected_course = searchBox.value.toLowerCase();

            sectionListContainer.style.display = "block";
            sectionListContainer.innerHTML = "";

            // Get all the class times from the course_tab table
            const courseTimes = [];
            const courseRows = document.querySelectorAll('.course_tab tbody tr');
            courseRows.forEach(row => {
                const classTimeCell = row.querySelector('td:nth-child(3)'); // Class Time column
                if (classTimeCell) {
                    courseTimes.push(classTimeCell.textContent.trim());
                }
            });

            if (selected_course != '')
                sections
                .filter(item => ((item.section.toLowerCase().includes(filter) || item.time.toLowerCase().includes(filter)) && item.course.toLowerCase() == selected_course.trim()))
                .forEach(item => {
                    short_section.push(item);
                    const option = document.createElement("div");
                    option.classList.add("dropdown-item");

                    // Creating two separate elements for section and time
                    const sectionDiv = document.createElement("span");
                    sectionDiv.textContent = item.section;
                    sectionDiv.style.width = '15%';
                    sectionDiv.style.borderRight = '1.5px solid #ffffff40';
                    sectionDiv.style.marginRight = "30px";

                    const timeDiv = document.createElement("span");
                    timeDiv.textContent = item.time;
                    timeDiv.style.opacity = "0.8";

                    // Check for time clashes with the course times
                    const isClashing = courseTimes.some(courseTime => {
                        let a = `${item.section} - ${item.time}`;
                        let b = `1 - ${courseTime}`;
                        let [_1, days1, time1] = a.match(/- ([A-Z]+) ([\d:APM\s-]+)/) || [];
                        let [_2, days2, time2] = b.match(/- ([A-Z]+) ([\d:APM\s-]+)/) || [];
                        return timesIntersect(time1, time2) && (days1 === days2);
                    });


                    // If there is a time clash, add a "disabled" class to the option
                    if (isClashing) {
                        option.classList.add('disabled');
                        option.style.opacity = "0.5";
                        option.style.pointerEvents = "none";
                        option.style.background = "#ff000080";
                    }

                    // Append both parts to the option container
                    option.appendChild(sectionDiv);
                    option.appendChild(timeDiv);

                    option.onclick = () => {
                        if (!option.classList.contains('disabled')) {
                            sectionSearchBox.value = `${item.section} - ${item.time}`;
                            sectionSearchBox.style.color = '#ffffff';
                            sectionListContainer.innerHTML = "";
                            sectionListContainer.style.display = "none";
                        }
                    };
                    sectionListContainer.appendChild(option);
                });
        }

        sectionSearchBox.addEventListener("focus", filterSectionList);
        sectionSearchBox.addEventListener("input", filterSectionList);

        document.addEventListener("click", (event) => {
            if (!sectionSearchBox.contains(event.target) && !sectionListContainer.contains(event.target)) {
                sectionListContainer.style.display = "none";
            }
        });
    </script>

    <!-- add button js -->
    <script>
        // Array of colors
        const colors = ["rgb(218, 218, 0)", "rgb(0, 191, 255)", "rgb(144, 238, 144)", "rgb(255, 182, 193)", "rgb(221, 160, 221)"];

        // References to the input fields and table
        const addButton = document.getElementById("addButton");
        const courseInput = document.getElementById("search_box_course");
        const sectionInput = document.getElementById("search_box_section");
        const courseTable = document.querySelector(".course_tab tbody"); // Getting tbody for new rows

        addButton.addEventListener("click", function() {
            addCoursesToCourses();
            addCoursesToRoutine();
        });

        function addCoursesToCourses() {
            // Get selected course and section values
            const selectedCourse = courseInput.value.trim();
            const selectedSection = sectionInput.value.trim();
            let faculty, seats;

            if (!selectedCourse || !selectedSection) {
                alert("Please select both a course and a section.");
                return;
            }

            // Split section and time from the section input
            const [section, ...timeArray] = selectedSection.split(" - ");
            const time = timeArray.join(" - ").trim();

            // Create a new row
            const newRow = document.createElement("tr");

            short_section.forEach(sec => {
                if (sec.course == selectedCourse && sec.section == section) {
                    faculty = sec.faculty;
                    seats = sec.seats;
                }
            });

            // Add cells for each column with values or placeholders
            newRow.innerHTML = `
                <td>${selectedCourse}</td>
                <td>${section}</td>
                <td>${time}</td>
                <td>${faculty}</td>
                <td>${seats}</td>
                <td><button>&times;</button></td>
            `;

            courseTable.appendChild(newRow);
            newRow.querySelector("button").addEventListener("click", function() {
                courseTable.removeChild(newRow);
                let sectCors = newRow.querySelector('td').innerText;
                let tr_row = document.querySelectorAll(".routine_table .routine table tr");
                tr_row.forEach(row => {
                    let tr_row = row.querySelectorAll('td');
                    tr_row.forEach(td => {
                        if (td.innerText == sectCors) {
                            td.innerText = '';
                            td.style.backgroundColor = '#ffffff';
                        }
                    });
                });
            });
        }

        function addCoursesToRoutine() {
            const courseTitle = courseInput.value.trim();
            const sectionDetails = sectionInput.value.trim();
            // Extract days (like MW) and time (like 08:00 AM - 09:15 AM) from sectionDetails
            const [_, days, time] = sectionDetails.match(/- ([A-Z]+) ([\d:APM\s-]+)/) || [];

            if (!courseTitle || !days || !time) {
                console.warn("Please make sure both course title and section details are selected properly.");
                return;
            }

            const daysMapping = {
                'A': 1, // Saturday
                'S': 2, // Sunday
                'M': 3, // Monday
                'T': 4, // Tuesday
                'W': 5, // Wednesday
                'R': 6 // Thursday
            };

            // Choose a random color from the array
            const color = colors[Math.floor(Math.random() * colors.length)];

            // Loop through each day in days (e.g., 'MW' -> Monday, Wednesday)
            for (let day of days) {
                const dayColumn = daysMapping[day];
                if (dayColumn) {
                    // Locate the correct row by matching the time
                    const rows = document.querySelectorAll(".routine_table .routine table tr");

                    rows.forEach((row) => {
                        const timeCell = row.querySelector("th");
                        // if (normalizeTime(timeCell.textContent.trim()) === normalizeTime(time.trim())) {
                        // console.log((timeCell), 1);
                        // console.log(2, normalizeTime(time.trim()));
                        if (normalizeTime(timeCell.textContent.trim()) != '') {
                            if (timesIntersect(normalizeTime(timeCell.textContent.trim()), normalizeTime(time.trim()))) {
                                const targetCell = row.cells[dayColumn];
                                if (targetCell) {
                                    targetCell.style.backgroundColor = color;
                                    targetCell.textContent = courseTitle;
                                } else {
                                    console.warn(`No cell found for day ${day} and time ${time}`);
                                }
                            }
                        }
                    });
                }
            }

            // Clear input fields after adding
            courseInput.value = "";
            sectionInput.value = "";
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

    <!-- controll button js -->
    <script>
        function cleanAll() {
            let routineRows = document.querySelectorAll('.routine table tr');
            let courseRow = document.querySelector('.course_tab table tbody');

            routineRows.forEach(row => {
                row.querySelectorAll('td').forEach(td => {
                    td.innerHTML = '';
                    td.style.background = '#fff';
                });
            });

            courseRow.innerHTML = '';

        }
    </script>

    <!-- array setup functions -->
    <script>
        let courseDict = [];

        function make_dictionary() {
            courseDict = [];
            let table = document.querySelector(".course_tab table");

            for (let i = 1; i < table.rows.length; i++) {
                let row = table.rows[i];
                let entry = {
                    course: row.cells[0].innerText,
                    section: row.cells[1].innerText,
                    time: row.cells[2].innerText,
                    faculty: row.cells[3].innerText,
                    seats: row.cells[4].innerText
                };
                courseDict.push(entry);
            }
        }

        function find_json(course) {
            // console.log(course);
            return courseDict.find(dict => dict.course === course);
        }

        function saveRoutine() {
            make_dictionary();
            let jsonData = [];
            let tab_row = document.querySelectorAll('.routine table tr');

            tab_row.forEach(row => {
                if (row.dataset.rownum != 0) {
                    let row_td = row.querySelectorAll('td');
                    row_td.forEach(td => {
                        if (td.innerText != '') {
                            let cor = find_json(td.innerText);
                            let entry = {
                                course: td.innerText,
                                row: row.dataset.rownum,
                                col: td.dataset.colnum,
                                section: cor.section,
                                time: cor.time,
                                faculty: cor.faculty,
                                seats: cor.seats,
                                color: td.style.backgroundColor || "none" // Handle empty color
                            };
                            jsonData.push(entry);
                        }
                    });
                }
            });

            let sendJSON = JSON.stringify(jsonData);

            sendPostRequest('/custom_routine', 'save_routine', [['jsondata', sendJSON]]).then(response => {
                if (response.message != 'success') {
                    // errorMessage.textContent = response.message; // Display error message
                    alert(response.message);
                }
                else {
                    alert("Routine saved succesfully!");
                }
            });
        }
    </script>

</body>

</html>

