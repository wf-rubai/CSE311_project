<!DOCTYPE html>
<html>
<head>
    <title>SQL Executor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        textarea {
            width: 100%;
            height: 100px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>SQL Executor</h1>
    <form method="post">
        <label for="sql">Enter your SQL query:</label><br>
        <textarea name="sql" id="sql"><?php echo isset($_POST['sql']) ? $_POST['sql'] : ''; ?></textarea><br><br>
        <input type="submit" value="Execute">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['sql'])) {

        #connect to db
        $conn = connect();

        $sql = $_POST['sql'];
        $result = $conn->query($sql);

        if ($result === FALSE) {
            echo "<p class='error'>Error: " . $conn->error . "</p>";
        } else {
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>";

                // Print table headers
                $fields = $result->fetch_fields();
                foreach ($fields as $field) {
                    echo "<th>" . $field->name . "</th>";
                }
                echo "</tr>";

                // Print table rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . $cell . "</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No results found.</p>";
            }
        }

        $conn->close();
    }
    ?>
</body>
</html>