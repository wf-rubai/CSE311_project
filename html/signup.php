<?php
    require "php/signupFunction.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json');
        $response = signup($_POST['nsu_id'], $_POST['email'], $_POST['password'], $_POST['confirmPassword']);
        echo json_encode(['message' => $response]);

        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up Page</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('http://ece.northsouth.edu/wp-content/uploads/2015/08/rajesh-pp-photo.jpg'); /* Replace 'your-image-path.jpg' with the actual path of your image */
            background-size: contain;
            background-position: center;
            /* background-repeat: no-repeat; */
        }

        .signup-container {
            background-color: #ffffffb5;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .signup-form h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .input-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .signup-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #2196F3;
            border: none;
            color: white;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .signup-btn:hover {
            background-color: #1976D2;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
        }

        .login-link a {
            color: #2196F3;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message, .success-message {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }
    </style>
</head>
<body>
    <div class="signup-container container">
        <form id="signupForm" class="signup-form" method="POST">
            <h2>Sign Up</h2>
            <div class="input-group">
                <label for="nsu_id">NSU ID</label>
                <input type="text" id="nsu_id" name="nsu_id" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password"><i>Password</i></label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirmPassword"><i>Confirm Password</i></label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit" name="signup" class="signup-btn">Sign Up</button>
            <p class="login-link">Already have an account? <a href="/login">Login here</a></p>
            <p class="error-message" id="errorMessage"></p>
            <p class="success-message" id="successMessage"></p>
        </form>
    </div>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear any previous messages
            const errorMessage = document.getElementById('errorMessage');
            const successMessage = document.getElementById('successMessage');
            errorMessage.textContent = '';
            successMessage.textContent = '';

            // Get form values
            const form = document.getElementById('signupForm');
            const username = document.getElementById('nsu_id').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Validate input
            if (!username || !email || !password || !confirmPassword) {
                errorMessage.textContent = 'All fields are required!';
                return;
            }

            if (password !== confirmPassword) {
                errorMessage.textContent = 'Passwords do not match!';
                return;
            }

            // Send AJAX POST request using fetch
            fetch('/signup', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded', // Set header for URL encoded data
                },
                body: new URLSearchParams(new FormData(form)) // Send serialized form data
            })
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                if (data.message) {
                    if(data.message != "success") {
                        errorMessage.textContent = data.message; // Display success message
                    }
                    else {
                        successMessage.textContent = 'You have successfully signed up! Redirecting to login page...';
                
                        // Simulate redirect to login page
                        setTimeout(function() {
                            window.location.href = '/login'; // Replace with actual login page
                        }, 2000);
                    }
                } else {
                    errorMessage.textContent = "An error occurred. Please try again."; // Display error message
                }
            })
            .catch(error => {
                errorMessage.textContent = "There was an error processing the form.";
                console.error("Fetch Error:", error); // Log fetch error details
            });
            
        });
    </script>
</body>
</html>
