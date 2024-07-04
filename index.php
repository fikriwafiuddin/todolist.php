<?php
include 'functions.php';
session_start();

// Cek session
if (!isset($_SESSION["login"])) {
    header("Location: register.php");
    exit;
}

// Cek cookie
if (isset($_COOKIE['!87yghgggkkh']) || isset($_COOKIE['!!kljasjljnhekls'])) {
    $id = $_COOKIE['!87yghgggkkh'];
    $email = $_COOKIE['!kljasjljnhekls'];

    // Take email from id
    $result = mysqli_query($conn, "SELECT email FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // Cek cookie and email
    if ($id === hash("sha256", $row["email"])) {
        $_SESSION['login'] = true;
    }
}

// Get todo
$id = $_COOKIE["!87yghgggkkh"];
$sql = "SELECT * FROM todo WHERE idUser = '$id'";
$result = $conn->query($sql);

// Add task
if (isset($_POST["submit"])) {
    $text = htmlspecialchars_decode($_POST['text']);
    $email = "fikriwafiuddin@gmail.com";
    $id = NULL;
    $idUser = $_COOKIE['!87yghgggkkh'];

    $stmt = $conn->prepare("INSERT INTO todo (id, text, email, idUser) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $text, $email, $idUser);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>To-Do List</h1>
        <div class="auth-buttons">
            <a href="logout.php" class="btn logout">Logout</a>
        </div>
    </header>

    <main>
        <section class="todo-list">
            <h2>My To-Do List</h2>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                                                                                                                                                            <li><input type="checkbox"><span class="task-text"><?= $row["text"] ?></span>
                                                                                                                                                                <div class="task-actions">
                                                                                                                                                                    <a href="delete.php?id=<?= $row["id"] ?>" class="btn delete-task">Delete</a>
                                                                                                                                                                </div>
                                                                                                                                                            </li>
                <?php endwhile; ?>
            </ul>
            <form action="" method="post">
                <input type="text" placeholder="Add a new task..." name="text" required>
                <button class="btn add-task" type="submit" name="submit">Add Task</button>
            </form>
        </section>
    </main>
</body>
</html>
