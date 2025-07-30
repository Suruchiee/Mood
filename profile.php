<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

$user_id = $_SESSION['user_id'];
$message = "";

// Update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $email, $user_id);

    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile.";
    }
    $stmt->close();
}

// Fetch user info
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile - MoodTune</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ff4081, #4fc3f7);
            color: #fff;
        }

        .navbar {
            background-color: #4fc3f7;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 12px;
            font-weight: bold;
            padding: 8px 14px;
            border-radius: 6px;
        }

        .navbar a:hover {
            background-color: #0288d1;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.15);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h2 {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"] {
            width: 80%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            margin: 12px 0;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #7e57c2;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #5e35b1;
        }

        .message {
            margin-top: 15px;
            font-weight: bold;
            color: #ffd740;
        }

    </style>
</head>
<body>

<div class="navbar">
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="mood-detect.php">Mood Detection</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
    </div>
    <div>
        <a href="logout.php" style="background-color: #ff4081;">Logout</a>
    </div>
</div>



</body>
</html>

<?php
include_once "auth_check.php";
session_start();

$pageTitle = "Profile";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

$user_id = $_SESSION['user_id'];
$message = "";

// Update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $email, $user_id);

    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile.";
    }
    $stmt->close();
}

// Fetch user info
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

ob_start();
?>

<div class="container">
    <h2>Your Profile</h2>
    <form method="POST">
        <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required><br>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br>
        <input type="submit" value="Update Profile">
    </form>
    <div class="message"><?= $message ?></div>
</div>




<?php
include_once "dashboard_base.php";
?>