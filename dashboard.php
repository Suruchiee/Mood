<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodTune Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1c1c1c;
            color: white;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(90deg, #ff4081, #4fc3f7, #7e57c2);
            padding: 12px 20px;
            border-radius: 12px;
            margin: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 14px;
            transition: all 0.3s ease-in-out;
            border-radius: 8px;
        }

        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
        }

        .nav-left a {
            margin-right: 15px;
        }

        .logout-btn {
            background-color: rgba(255, 64, 129, 0.6);
            padding: 8px 14px;
        }

        .logout-btn:hover {
            background-color: rgba(255, 64, 129, 0.85);
        }

        /* Mood Detection Box */
        .mood-box {
            text-align: center;
            padding: 30px;
            margin: 20px auto;
            width: 60%;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
        }

        .mood-btn {
            background: linear-gradient(45deg, #ff4081, #4fc3f7);
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .mood-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #ff4081;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="nav-left">
            <a href="dashboard.php">Dashboard</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </div>
        <div class="nav-right">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <!-- Mood Detection Interface -->
    <div class="mood-box">
        <h2>Welcome, <?php echo $_SESSION['username']; ?> 🎵</h2>
        <p>Click below to detect your mood and get a song suggestion!</p>
        <form action="mood_detect.php" method="post">
            <button type="submit" class="mood-btn">Start Mood Detection</button>
        </form>
    </div>

</body>
</html>
