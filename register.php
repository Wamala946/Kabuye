<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .registration-container {
            width: 400px;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body registration-container">
                        <?php
                        // CSRF Token
                        session_start();
                        if (!isset($_SESSION['token'])) {
                            $_SESSION['token'] = bin2hex(random_bytes(32));
                        }

                        // Input Sanitization Function
                        function sanitizeInput($input) {
                            return htmlspecialchars(strip_tags(trim($input)));
                        }

                        // Email Validation Function
                        function validateEmail($email) {
                            return filter_var($email, FILTER_VALIDATE_EMAIL);
                        }

                        // Password Strength Checker
                        function checkPasswordStrength($password) {
                            $strength = 0;
                            if (preg_match('/[A-Z]/', $password)) $strength++;
                            if (preg_match('/[a-z]/', $password)) $strength++;
                            if (preg_match('/\d/', $password)) $strength++;
                            if (strlen($password) >= 8) $strength++;

                            return $strength;
                        }

                        // Registration Form
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $errors = [];

                            $username = sanitizeInput($_POST['username']);
                            $name = sanitizeInput($_POST['name']);
                            $email = sanitizeInput($_POST['email']);
                            $phone = sanitizeInput($_POST['phone']);
                            $password = $_POST['password'];

                            // Validate inputs
                            if (empty($username)) {
                                $errors[] = "Username is required.";
                            }
                            if (empty($name)) {
                                $errors[] = "Full name is required.";
                            }
                            if (!validateEmail($email)) {
                                $errors[] = "Invalid email address.";
                            }
                            if (empty($phone)) {
                                $errors[] = "Phone number is required.";
                            }
                            if (empty($password) || !checkPasswordStrength($password) >= 3) {
                                $errors[] = "Password must be at least 8 characters long and contain uppercase letters, lowercase letters, and numbers.";
                            }

                            // CSRF protection
                            if (!hash_equals($_SESSION['token'], $_POST['_csrf_token'])) {
                                $errors[] = "CSRF token mismatch.";
                            }

                            // Display errors
                            if ($errors) {
                                foreach ($errors as $error) {
                                    echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
                                }
                            } else {
                                // Registration successful
                                echo "<div class='alert alert-success'>Registration successful! Please check your email for verification.</div>";
                                // Here you would typically send a confirmation email and store the user data in the database
                            }
                        }
                        ?>
                        <form>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter username" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Full Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter full name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Enter phone number" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-3"><a href="edit.php"></a>Register</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p>Already have an account? <a href="front.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
