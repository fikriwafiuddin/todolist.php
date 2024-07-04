<?php
include "functions.php";
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    // Cek email
    if (mysqli_num_rows($result) === 1) {
        // Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // Set session
            $_SESSION["login"] = true;

            // Remember me
            if (isset($_POST["rememberme"])) {
                // Set cookie
                setcookie("!87yghgggkkh", $row['id'], time() + 60 * 60 * 24 * 60);
                setcookie("!kljasjljnhekls", hash('sha256', $row['email']), time() + 60 * 60 * 24 * 60);
            }

            header("Location: index.php");
            exit;
        }
    }

    echo "<script>alert('User not found, email or password is wrong')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center">Login</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                    </div>
                    <div class="rememberme">
                        <input name="rememberme" type="checkbox" id="rememberme">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <button name="login" type="submit" class="btn btn-custom btn-block">Login</button>
                    <div class="text-center mt-3">
                        <a href="register.php" class="text-primary">Don't have an account? Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
