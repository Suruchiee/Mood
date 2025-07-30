<?php
include 'db.php';
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "User not found.";
    }

    $stmt->close();
    $conn->close();
}

$pageTitle = "MoodTune - Login";

$content = <<<EOD
<div class="form-container">
    <h2>Login to MoodTune</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Enter your username" required><br>
        <input type="password" name="password" placeholder="Enter your password" required><br>
        <input type="submit" value="Login">
    </form>
    <div class="message">$message</div>
    <a href="register.php">Don't have an account? Register here</a>
</div>
EOD;

include_once "base.php";
?>
