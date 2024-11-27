<?php

function add_faculty($faculty_name, $faculty_initial) {
    #connect to db
    $mysqli = connect();

    // Query to get all data from the table
    $sql = "INSERT INTO faculty (initial, fullname)
            VALUES ('". $faculty_name."', '". $faculty_initial ."')";

    $result = $mysqli->query($sql);

    // Check if there are any results
    if ($result == TRUE) {
        return 'success';

    } else {
        return null;
    }
}

function update_faculty($faculty_initial,$faculty_name){
    $mysqli= connect();
    $sql = "UPDATE faculty SET fullname = '$faculty_name' WHERE initial = '$faculty_initial'";

    if ($mysqli->query($sql) === TRUE) {
        return "success";
    } else {
        return null;
    }

}

function delete_faculty($faculty_initial){
    $mysqli=connect();
    $sql = "DELETE from faculty where initial = '$faculty_initial'";
    if ($mysqli->query($sql) === TRUE) {
        return "success";
    } else {
        return null;
    }

}

function get_faculties() {
    #connect to db
    $mysqli = connect();

    // Query to get all data from the table
    $sql = "SELECT f.initial, f.fullname FROM faculty f";

    $result = $mysqli->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output data of the first row (or loop through rows if needed)
        return $result;

    } else {
        return null;
    }
}

?>