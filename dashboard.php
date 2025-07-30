<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'] ?? 'User';

// Determine greeting based on time
$hour = date('H');
if ($hour < 12) {
    $greeting = "Good Morning";
} elseif ($hour < 18) {
    $greeting = "Good Afternoon";
} else {
    $greeting = "Good Evening";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - MoodTune</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ff4081, #7e57c2);
            color: #fff;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .navbar a:hover {
            background-color: #4fc3f7;
            box-shadow: 0 0 10px #4fc3f7;
        }

        .logout-btn {
            background-color: #e53935;
        }

        .logout-btn:hover {
            background-color: #c62828;
            box-shadow: 0 0 10px #e57373;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .welcome {
            font-size: 28px;
            margin-bottom: 10px;
            color: #fff;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .card {
            width: 280px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(6px);
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            text-align: left;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.4);
        }

        .card h3 {
            color: #ffca28;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 15px;
            margin-bottom: 15px;
            color: #eee;
        }

        .card a {
            display: inline-block;
            text-decoration: none;
            padding: 10px 16px;
            background-color: #4fc3f7;
            color: #000;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .card a:hover {
            background-color: #039be5;
            box-shadow: 0 0 10px #81d4fa;
        }

        @media screen and (max-width: 768px) {
            .features {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="mood-detect.php">Mood Detector</a>
        <a href="profile.php">Profile</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
    </div>
    <div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<div class="container">
    <p class="welcome"><?= $greeting ?>, <strong><?= htmlspecialchars($username) ?></strong> 👋</p>
    <p>Welcome back to MoodTune. Let’s match your mood with the perfect tunes!</p>

    <div class="features">
        <div class="card">
            <h3>Mood Detection</h3>
            <p>Start detecting your current mood and receive personalized suggestions.</p>
            <a href="mood-detect.php">Detect Mood</a>
        </div>

        <div class="card">
            <h3>Profile</h3>
            <p>Update your email, profile picture, or password anytime here.</p>
            <a href="profile.php">Edit Profile</a>
        </div>

        <div class="card">
            <h3>Saved Songs</h3>
            <p>Check the songs you've saved while browsing your moods.</p>
            <a href="saved.php">Coming Soon</a>
        </div>
    </div>
</div>

</body>
</html>
