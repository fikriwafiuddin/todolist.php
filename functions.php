<?php
$conn = new mysqli("localhost", "root", "", "todolist");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function register_user($data)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek if fields is empty
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please add all fields')</script>";
        return false;
    }

    // Cek if user is already exist
    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
    if (mysqli_num_rows($result) === 1) {
        echo "<script>alert('This email is already exist')</script>";
        return false;
    }

    // Cek confirm password
    if ($password !== $password2) {
        echo "<script>alert('Confirm password correctly')</script>";
        return false;
    }

    // Encryption password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Add user to database
    $result = mysqli_query($conn, "INSERT INTO user VALUES('', '$email', '$password')");

    // Set session
    $_SESSION["login"] = true;

    // Remember me
    if (isset($_POST["rememberme"])) {
        // Set cookie
        $id = mysqli_insert_id($conn);
        setcookie("!87yghgggkkh", $id, time() + 60 * 60 * 24 * 60);
        setcookie("!kljasjljnhekls", hash('sha256', $email), time() + 60 * 60 * 24 * 60);
    }

    return mysqli_affected_rows($conn);
}
?>