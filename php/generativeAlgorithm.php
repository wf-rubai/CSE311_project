<?php
echo '<pre>';

$json_str = '[{"course":"cse115", "cr": 3},{"course":"mat116", "cr": 3},{"course":"eng102", "cr": 3},{"course":"eee154", "cr": 1}, {"min_cr": 5, "max_cr": 10}]';
$json = json_decode($json_str, true);
$courses = [];
for($i = 0; $i < count($json)-1; $i++){
    $courses[] = $json[$i];
}

// $courses = json_decode($course_json, true);
// $courses = ["cse115", "mat116", "eng102", "cse115l", "cse311l"];
$courses_comb = generate_course_combinations($courses);
print_r($courses);

// $courses_set = fetch_course_list($courses);

function credit_in_between($courses){
    global $json;
    $count = 0;
    foreach($courses as $crs){
        $count += $crs['cr'];
    }

    if($count >= $json[count($json)-1]['min_cr'] && $count <= $json[count($json)-1]['max_cr']){
        return true;
    }else{
        return false;
    }
}

function generate_course_combinations($courses) {
    $result = [];
    $n = count($courses);

    // Helper function to generate combinations
    function combinations_helper($courses, $current, $index, &$result) {
        // Add current combination to the result
        if(credit_in_between($current)){
            $result[] = $current;
        }

        // Iterate through the array starting from the current index
        for ($i = $index; $i < count($courses); $i++) {
            // Include the current element and recurse
            $current[] = $courses[$i];
            combinations_helper($courses, $current, $i + 1, $result);
            // Backtrack: remove the last added element
            array_pop($current);
        }
    }

    // Call the helper with an empty current combination
    combinations_helper($courses, [], 0, $result);
    print_r($result);
    return $result;
}

function fetch_course_list($courses){
    $conn = connect();
    foreach($courses as $cour){
        $sql = "SELECT c.course, CONCAT(c.days,' ', c.start, ' - ', c.end) as time 
                FROM courses c
                WHERE c.course = '{$cour['course']}'
                GROUP BY time
                LIMIT 4";

        $result = $conn->query($sql);
        $temp = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $temp[] = $row;
            }
            $courses_set[] = $temp;
        }
    }
    return $courses_set;
}

function check_time_clash($routine) {
    // Check if there is any time clash in the routine
    for ($i = 0; $i < count($routine); $i++) {
        for ($j = $i + 1; $j < count($routine); $j++) {
            // Compare times of two different courses
            if (is_time_clash($routine[$i]['time'], $routine[$j]['time'])) {
                return true; // Time clash found
            }
        }
    }
    return false; // No clash
}

function is_time_clash($time1, $time2) {
    // Parse the start and end times for both inputs
    preg_match('/([STMWRAstmwra]{1})([STMWRAstmwra]{0,1}) (\d{1,2}:\d{2} [APM]{2}) - (\d{1,2}:\d{2} [APM]{2})/', $time1, $matches1);
    preg_match('/([STMWRAstmwra]{1})([STMWRAstmwra]{0,1}) (\d{1,2}:\d{2} [APM]{2}) - (\d{1,2}:\d{2} [APM]{2})/', $time2, $matches2);
    
    $matches1[1] = strtolower($matches1[1]);
    $matches1[2] = strtolower($matches1[2]);
    $matches2[1] = strtolower($matches2[1]);
    $matches2[2] = strtolower($matches2[2]);    

    if (!$matches1 || !$matches2) {
        return false; // Invalid time format
    }elseif (!($matches1[1] == $matches2[1] || $matches1[1] == $matches2[2] || $matches1[2] == $matches2[1] || ($matches1[2] == $matches2[2] && $matches1[2] != '' && $matches2[2] != ''))){
        return false;
    }

    // Convert times to 24-hour format for easier comparison
    $start1 = strtotime($matches1[3]);
    $end1 = strtotime($matches1[4]);
    $start2 = strtotime($matches2[3]);
    $end2 = strtotime($matches2[4]);

    // Check if the times overlap
    return !($end1 <= $start2 || $end2 <= $start1);
}

function generate_routines($courses_set) {
    $routines = [];
    $combinations = generate_all_combinations();

    $routine_number = 1; // Start counting routines
    foreach ($combinations as $combination) {
        if (!check_time_clash($combination)) {
            $routines[] = [
                'table' => $routine_number,
                'routine' => $combination
            ];
            $routine_number++;
        }
    }
    return $routines;
}

function generate_all_combinations(){
    global $courses_comb;
    $combination = [];
    foreach($courses_comb as $course){
        $courses_set = fetch_course_list($course);

        $combination = array_merge($combination, generate_sub_combinations($courses_set));
    }
    return $combination;
}

function generate_sub_combinations($courses_set) {
    $combinations = [];
    $course_count = count($courses_set);
    $indices = array_fill(0, $course_count, 0); // Initialize all indices to 0

    while (true) {
        $combination = [];
        for ($i = 0; $i < $course_count; $i++) {
            $combination[] = $courses_set[$i][$indices[$i]];
        }
        $combinations[] = $combination;

        // Move to the next combination
        $i = $course_count - 1;
        while ($i >= 0) {
            if ($indices[$i] < count($courses_set[$i]) - 1) {
                $indices[$i]++;
                break;
            } else {
                $indices[$i] = 0;
                $i--;
            }
        }
        if ($i < 0) {
            break;
        }
    }

    return $combinations;
}
$routines = generate_routines($courses_set);

$temps = json_encode($routines);
echo "<script> console.log($temps)</script>";


echo '</pre>';
?>
