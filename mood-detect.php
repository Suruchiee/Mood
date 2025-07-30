<?php
include_once("auth_check.php");

session_start();
$username = $_SESSION['username'] ?? 'User';

$pageTitle = "Mood Detection - MoodTune";

ob_start();

// Mood to background color mapping for container dynamic theming
$mood_bg_colors = [
    "happy" => "linear-gradient(135deg, #ffecb3, #ffee58, #ffca28)", // warm yellow gradient
    "sad" => "linear-gradient(135deg, #90caf9, #42a5f5, #1e88e5)", // calming blue gradient
    "excited" => "linear-gradient(135deg, #ff80ab, #ff4081, #f50057)", // bright pink/red
    "angry" => "linear-gradient(135deg, #ef5350, #e53935, #b71c1c)", // intense red gradient
    "relaxed" => "linear-gradient(135deg, #80cbc4, #26a69a, #00796b)", // soothing teal
    "romantic" => "linear-gradient(135deg, #f48fb1, #f06292, #ec407a)", // soft pinks
];

$mood = "";
$suggested_song = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mood = strtolower(trim($_POST["user_input"]));

    $mood_songs = [
        "happy" => "🎵 'Happy' by Pharrell Williams",
        "sad" => "🎵 'Someone Like You' by Adele",
        "excited" => "🎵 'Can't Stop the Feeling' by Justin Timberlake",
        "angry" => "🎵 'In the End' by Linkin Park",
        "relaxed" => "🎵 'Weightless' by Marconi Union",
        "romantic" => "🎵 'Perfect' by Ed Sheeran"
    ];

    if (array_key_exists($mood, $mood_songs)) {
        $suggested_song = $mood_songs[$mood];
    }
}

$dynamic_bg = $mood && isset($mood_bg_colors[$mood]) ? $mood_bg_colors[$mood] : "linear-gradient(135deg, #ff4081, #4fc3f7, #7e57c2)";

// Time-based greeting
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
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <style>
        /* Reset and base */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ff4081, #7e57c2);
            color: #fff;
            min-height: 100vh;
        }

        /* Navbar - same as dashboard */
        .navbar {
            background-color: rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            position: sticky;
            top: 0;
            z-index: 100;
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

        /* Main container for mood detection */
        .mood-container {
            max-width: 480px;
            margin: 60px auto 40px auto;
            padding: 35px 30px;
            border-radius: 20px;
            background: <?= $dynamic_bg ?>;
            box-shadow:
                0 0 15px #ff4081,
                0 0 25px #4fc3f7,
                0 0 35px #7e57c2;
            text-align: center;
            transition: background-color 0.5s ease;
        }

        h2 {
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 2rem;
            text-shadow: 0 0 8px #fff;
        }

        form input[type="text"] {
            width: 85%;
            padding: 14px 20px;
            border-radius: 35px;
            border: none;
            outline: none;
            font-size: 1.15rem;
            margin-bottom: 25px;
            box-shadow:
                inset 0 0 12px #fff8;
            transition: box-shadow 0.3s ease;
        }

        form input[type="text"]:focus {
            box-shadow:
                inset 0 0 18px #ff4081,
                0 0 10px #ff4081;
            background-color: #fff2f8;
            color: #222;
        }

        form button {
            background: #ff4081;
            color: white;
            font-size: 1.15rem;
            padding: 14px 40px;
            border-radius: 35px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            box-shadow:
                0 0 14px #ff4081;
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }

        form button:hover {
            box-shadow:
                0 0 22px #ff4081,
                0 0 38px #ff4081;
            transform: scale(1.07);
        }

        .result {
            margin-top: 28px;
            font-size: 1.25rem;
            font-weight: 600;
            padding: 18px 25px;
            border-radius: 20px;
            box-shadow:
                0 0 15px #7e57c2;
            background: rgba(255 255 255 / 0.18);
            text-shadow: 0 0 7px #fff;
        }

        @media screen and (max-width: 520px) {
            .mood-container {
                margin: 40px 20px;
                padding: 25px 20px;
            }
            form input[type="text"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="mood-detect.php" style="background:#4fc3f7; box-shadow: 0 0 10px #4fc3f7;">Mood Detector</a>
        <a href="profile.php">Profile</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
    </div>
    <div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<!-- Mood Detector container -->
<div class="mood-container">
    <h2>How are you feeling today?</h2>
    <form method="post" autocomplete="off">
        <input type="text" name="user_input" placeholder="Type your mood (e.g., happy, sad, excited)" required />
        <button type="submit">Detect Mood</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <div class="result">
            <?php 
            if ($suggested_song) {
                echo "Detected Mood: <strong>" . htmlspecialchars($mood) . "</strong><br>";
                echo "Suggested Song: " . htmlspecialchars($suggested_song);
            } else {
                echo "Mood not recognized. Try: happy, sad, relaxed, angry, etc.";
            }
            ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
