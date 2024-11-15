<?php

    function get_faculties() {
        #connect to db
        $mysqli = connect();

        // Query to get all data from the table
        $sql = "SELECT f.initial, f.fullname, AVG(r.learning_points) AS 'learning_points', AVG(r.grading_points) AS 'grading_points'
                FROM faculty f LEFT JOIN review r ON f.initial = r.review_of
                GROUP BY f.initial";

        $result = $mysqli->query($sql);

        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output data of the first row (or loop through rows if needed)
            return $result;

        } else {
            return null;
        }
    }

    function get_reviews_of_faculty($faculty_initial) {
        #connect to db
        $mysqli = connect();

        // Query to get all data from the table
        $sql = "SELECT * FROM review
                WHERE review_of = '". $faculty_initial ."'";

        $result = $mysqli->query($sql);

        // Check if there are any results
        if ($result->num_rows > 0) {
            $data = array(); // Initialize an empty array to hold the data
            // Fetch each row and add it to the data array
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            return $data;

        } else {
            return null;
        }
    }

    function add_review($faculty_initial, $is_anonymous, $review_by, $learning_points, $grading_points, $comments) {
        #connect to db
        $mysqli = connect();

        // Query to get all data from the table
        $sql = "INSERT INTO review (review_of, is_anonymous, review_by, learning_points, grading_points, user_comment)
                VALUES ('". $faculty_initial ."', ". $is_anonymous .", ". ($is_anonymous == 1 ? 'NULL' : $review_by) .", ". $learning_points .", ". $grading_points .", '". $comments ."')";

        $result = $mysqli->query($sql);

        // Check if there are any results
        if ($result == TRUE) {
            return 'success';

        } else {
            return null;
        }
    }

?>