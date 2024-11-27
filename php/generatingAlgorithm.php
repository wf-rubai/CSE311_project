<?php
$data = json_decode(file_get_contents("php://input"), true);
$json = $data['courses'];
$courses = [];
for($i = 0; $i < count($json)-1; $i++){
    $courses[] = $json[$i];
}

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

    function combinations_helper($courses, $current, $index, &$result) {
        if(credit_in_between($current)){
            $result[] = $current;
        }

        for ($i = $index; $i < count($courses); $i++) {
            $current[] = $courses[$i];
            combinations_helper($courses, $current, $i + 1, $result);
            array_pop($current);
        }
    }

    combinations_helper($courses, [], 0, $result);
    return $result;
}

function fetch_course_list($courses){
    $conn = connect();
    foreach($courses as $cour){
        $sql = "SELECT c.course, CONCAT(c.days,' ', c.start, ' - ', c.end) as time, '{$cour['color']}' as color
                FROM courses c
                WHERE c.course = '{$cour['course']}'
                GROUP BY time";

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
    for ($i = 0; $i < count($routine); $i++) {
        for ($j = $i + 1; $j < count($routine); $j++) {
            if (is_time_clash($routine[$i]['time'], $routine[$j]['time'])) {
                return true;
            }
        }
    }
    return false;
}

function is_time_clash($time1, $time2) {
    preg_match('/([STMWRAstmwra]{1})([STMWRAstmwra]{0,1}) (\d{1,2}:\d{2} [APM]{2}) - (\d{1,2}:\d{2} [APM]{2})/', $time1, $matches1);
    preg_match('/([STMWRAstmwra]{1})([STMWRAstmwra]{0,1}) (\d{1,2}:\d{2} [APM]{2}) - (\d{1,2}:\d{2} [APM]{2})/', $time2, $matches2);
    
    $matches1[1] = strtolower($matches1[1]);
    $matches1[2] = strtolower($matches1[2]);
    $matches2[1] = strtolower($matches2[1]);
    $matches2[2] = strtolower($matches2[2]);    

    if (!$matches1 || !$matches2) {
        return false; 
    }elseif (!($matches1[1] == $matches2[1] || $matches1[1] == $matches2[2] || $matches1[2] == $matches2[1] || ($matches1[2] == $matches2[2] && $matches1[2] != '' && $matches2[2] != ''))){
        return false;
    }

    $start1 = strtotime($matches1[3]);
    $end1 = strtotime($matches1[4]);
    $start2 = strtotime($matches2[3]);
    $end2 = strtotime($matches2[4]);

    return !($end1 <= $start2 || $end2 <= $start1);
}

function acceptable_day_count($course_list) {
    global $json;
    $days_of_week = ['A', 'S', 'M', 'T', 'W', 'R'];
    $days_taken = [];

    foreach ($course_list as $course) {
        $time = $course['time'];
        
        preg_match_all('/[A-Za-z]/', $time, $matches);

        foreach ($matches[0] as $day) {
            if (in_array($day, $days_of_week)) {
                $days_taken[$day] = true;
            }
        }
    }

    return count($days_taken) <= $json[count($json)-1]['day_num'];
}

function generate_routines() {
    $routines = [];
    $combinations = generate_all_combinations();

    $routine_number = 1; 
    foreach ($combinations as $combination) {
        if (!check_time_clash($combination) && acceptable_day_count($combination)) {
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

function generate_sub_combinations($courses_set, $indices = [], $combinations = []) {
    // Base case: if we've processed all courses
    if (count($indices) == count($courses_set)) {
        // Build the combination from the current indices
        $combination = [];
        foreach ($indices as $i => $index) {
            $combination[] = $courses_set[$i][$index];
        }
        // Add the combination to the list of combinations
        $combinations[] = $combination;
        return $combinations;
    }

    // Recursive case: process the next course
    $current_course = $courses_set[count($indices)];
    $current_combinations = [];
    foreach ($current_course as $i => $course) {
        $new_indices = array_merge($indices, [$i]);
        $current_combinations = array_merge($current_combinations, generate_sub_combinations($courses_set, $new_indices, $combinations));
    }

    return $current_combinations;
}
$courses_comb = generate_course_combinations($courses);
$routines = generate_routines();
echo json_encode($routines);
?>
