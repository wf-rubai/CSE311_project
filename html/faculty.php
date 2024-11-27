<?php

    require "php/facultyFunction.php";

    #connect to db
    $mysqli = connect();

    $user_details = checkLogin();

    if($user_details['is_admin'] != TRUE) {
        header('Location: /login');
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['add_faculty'])) {
            $response = add_faculty($_POST['facultyInitial'], $_POST['facultyName']);
            if($response != null) {
                // echo json_encode(['message' => 'success', 'redirectUrl' => '/profile']);
            }
            else {
                // echo json_encode(['message' => 'Something went wrong!']);
            }
        }else if(isset($_POST['update_faculty'])) {
            $response = update_faculty($_POST['facultyInitial'], $_POST['facultyName']);
            if($response != null) {
                // echo json_encode(['message' => 'success', 'redirectUrl' => '/profile']);
            }
            else {
                // echo json_encode(['message' => 'Something went wrong!']);
            }  
        }else if(isset($_POST['delete_faculty'])) {
            $response = delete_faculty($_POST['facultyInitial']);
            if($response != null) {
                // echo json_encode(['message' => 'success', 'redirectUrl' => '/profile']);
            }
            else {
                // echo json_encode(['message' => 'Something went wrong!']);
            }  
        } 
        // exit();
    }
    
    $faculties = get_faculties();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom styling for the table and modal */
        .modal-content {
            background-color: #f9f9f9;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mt-5">Faculty Information</h2>

    <!-- Button to open modal -->
    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addFacultyModal">Add Faculty</button>

    <!-- Faculty Table -->
    <table class="table table-striped" id="facultyTable">
        <thead>
            <tr>
                <th>Faculty Initial</th>
                <th>Faculty Name</th>
                <th>Actions</th> <!-- Column for Update/Delete -->
            </tr>
        </thead>
        <tbody>
            <!-- Dynamic rows will be added here -->
            <?php
            if (isset($faculties)) {
                while ($faculty = $faculties->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $faculty['initial'] . "</td>";
                    echo "<td>" . $faculty['fullname'] . "</td>";
                    echo "<td>";
                    echo "<button class='btn btn-warning btn-sm update-btn' data-id='" . $faculty['initial'] . "' data-initial='" . $faculty['initial'] . "' data-fullname='" . $faculty['fullname'] . "' data-bs-toggle='modal' data-bs-target='#updateFacultyModal'>Update</button> ";
                    echo "<button class='btn btn-danger btn-sm delete-btn' data-id='" . $faculty['initial'] . "' data-initial='" . $faculty['initial'] . "'data-bs-toggle='modal' data-bs-target='#deleteFacultyModal'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Modal for Adding Faculty -->
    <div class="modal fade" id="addFacultyModal" tabindex="-1" aria-labelledby="addFacultyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFacultyModalLabel">Add Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="facultyForm" method="POST">
                        <div class="mb-3">
                            <label for="facultyInitial" class="form-label">Faculty Initial</label>
                            <input type="text" class="form-control" name="facultyInitial" id="facultyInitial" required>
                        </div>
                        <div class="mb-3">
                            <label for="facultyName" class="form-label">Faculty Name</label>
                            <input type="text" class="form-control" name="facultyName" id="facultyName" required>
                        </div>
                        <button type="submit" name="add_faculty" class="btn btn-primary">Add Faculty</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Updating Faculty -->
    <div class="modal fade" id="updateFacultyModal" tabindex="-1" aria-labelledby="updateFacultyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateFacultyModalLabel">Update Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateFacultyForm" method="POST">
                        <input type="hidden" class="form-control" name="facultyInitial" id="updateFacultyInitial" required>
                        <br>
                        <div class="mb-3">
                            <label for="updateFacultyName" class="form-label">Faculty Name</label>
                            <input type="text" class="form-control" name="facultyName" id="updateFacultyName" required>
                        </div>
                        <button type="submit" name="update_faculty" class="btn btn-primary">Update Faculty</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Deleting Faculty -->
    <div class="modal fade" id="deleteFacultyModal" tabindex="-1" aria-labelledby="deleteFacultyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFacultyModalLabel">Delete Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteFacultyForm" method="POST">
                        <input type="hidden" class="form-control" name="facultyInitial" id="deleteFacultyInitial" required>
                        <br>
                        <div class="mb-3">
                            <p>Are you sure you want to delete this faculty?</p>
                        </div>
                        <button type="submit" name="delete_faculty" class="btn btn-danger">Delete Faculty</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Populate the update modal with existing data
    document.querySelectorAll('.update-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('updateFacultyInitial').value = this.dataset.initial;
            document.getElementById('updateFacultyName').value = this.dataset.fullname;
        });
    });

    // Populate the update modal with existing data
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('deleteFacultyInitial').value = this.dataset.initial;
        });
    });
</script> 


</body>
</html>