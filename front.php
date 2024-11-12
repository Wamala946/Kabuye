<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, develop your idea with us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php
// CSRF Token Generation and Verification
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// CSRF Token Verification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!hash_equals($_SESSION['token'], $_POST['_csrf_token'])) {
        echo "<div class='alert alert-danger'>CSRF token mismatch.</div>";
    } else {
        // Form submission logic here
    }
}
?>
</head>


<body>
    <div class="jumbotron jumbotron-fluid bg-dark text-white text-center py-5">
        <h1 class="display-4">Welcome, develop your idea with us</h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="text-center">
                    <button class="btn btn-primary btn-lg mt-3">Login</button>
                    <button class="btn btn-secondary btn-lg mt-3"><a href="register.html">Register</a></button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Enter your credentials </h5>
                        <form>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password">
                            </div>
                            <button type="submit" class="btn btn-primary"><a href="edit.php">Log in</a></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>