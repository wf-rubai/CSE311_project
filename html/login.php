<?php
    require "php/loginFunction.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        header('Content-Type: application/json');
        if(isset($_POST['login'])) {
            $response = login($_POST['nsu_id'], $_POST['password']);
            if ($response != 'success') {
                echo json_encode(['message' => $response]);
            }
            else {
                echo json_encode(['redirectUrl' => '/profile']);
            }
        }

        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/common.js"></script>
    <title>Login Page</title>
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
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-form h2 {
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

        .login-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #4caf50;
            border: none;
            color: white;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-btn:hover {
            background-color: #45a049;
        }

        .register-link {
            text-align: center;
            margin-top: 1rem;
        }

        .register-link a {
            color: #4caf50;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 1rem;
        }
    </style>

    <script src="/js/common.js"></script>
</head>
<body>
    <div class="login-container container">
        <form id="loginForm" class="login-form">
            <h2>Login</h2>
            <div class="input-group">
                <label for="nsu_id">NSU ID</label>
                <input type="text" id="nsu_id" name="nsu_id" required>
            </div>
            <div class="input-group">
                <i>  <label for="password">Password</label>
                    <input type="password" id="password" name="password" required></i>
              
            </div>
            <button type="submit" class="login-btn" style="background-color: #333;">Login</button>
            <p class="register-link">Don't have an account? <a href="/signup">Register here</a></p>
            <p class="error-message" id="errorMessage"></p>
        </form>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear any previous error message
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.textContent = '';

            // Get form values
            const username = document.getElementById('nsu_id').value;
            const password = document.getElementById('password').value;

            // Basic validation
            if (!username || !password) {
                errorMessage.textContent = 'Both fields are required!';
                return;
            }

            sendPostRequestForm('/login', this, 'login').then(response => {
                if(response.message != 'success') {
                    errorMessage.textContent = response.message; // Display error message
                }
            });
        });
    </script>
</body>
</html>
