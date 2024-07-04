<?php
include 'functions.php';
session_start();

if (isset($_POST['submit'])) {
    if (register_user($_POST) > 0) {
        header('Location: index.php');
        exit;
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center">Register</h3>
                <form action="" method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input name="password2" type="password" class="form-control" id="password2" placeholder="Confirm Password" required>
                    </div>
                    <div class="rememberme">
                        <input name="rememberme" type="checkbox" id="rememberme">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-custom btn-block" name="submit">Register</button>
                    <div class="text-center mt-3">
                        <a href="login.php" class="text-primary">Already have an account? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
