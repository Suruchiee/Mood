<?php
include 'db.php';
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $email = trim($_POST["email"]);
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Username already taken.";
        } else {
            $stmt->close();

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                // Use $conn->insert_id to get last inserted id
                $_SESSION["user_id"] = $conn->insert_id;
                $_SESSION["username"] = $username;
                header("Location: dashboard.php");
                exit;
            } else {
                $message = "Something went wrong. Please try again.";
            }
        }

        $stmt->close();
    }
}

$pageTitle = "MoodTune - Register";

$content = <<<EOD
<div class="form-container">
    <h2>Create Your Account</h2>
    <p>Join MoodTune and get music suggestions based on your mood!</p>

    <form method="POST">
        <input type="text" name="username" placeholder="Choose a username" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Create a password" required>
        <input type="password" name="confirm_password" placeholder="Confirm password" required>
        <input type="submit" value="Register">
    </form>

    <div class="message">$message</div>
    <a href="login.php">Already have an account? Login</a>
</div>
EOD;

include_once "base.php";
?>
