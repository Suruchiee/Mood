<?php
$pageTitle = "Welcome to MoodTune";
include 'db.php'; // make sure your database connection file is included

// Fetch moods from database
$sql = "SELECT mood_name, mood_emoji, mood_color FROM moods LIMIT 6";
$result = $conn->query($sql);

$moodCards = "";
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = htmlspecialchars($row['mood_name']);
        $emoji = htmlspecialchars($row['mood_emoji']);
        $color = htmlspecialchars($row['mood_color']); // HEX color from DB
        $moodCards .= "<div class='mood-card' style='background: {$color}'>{$emoji} {$name}</div>";
    }
} else {
    $moodCards = "<p>No moods available right now.</p>";
}

$content = <<<EOD
<!-- Hero Section -->
<div class="hero">
    <h1>Welcome to MoodTune</h1>
    <p>Let your emotions decide your playlist. Discover music based on your mood!</p>
    <div class="cta">
        <a href="mood-detect.php" class="btn-primary">Detect My Mood</a>
        <a href="register.php" class="btn-secondary">Get Started</a>
    </div>
</div>

<!-- Features -->
<div class="features">
    <div class="card">
        <h3>AI Mood Detection</h3>
        <p>Our intelligent model senses your emotion and plays songs that match your vibe.</p>
    </div>
    <div class="card">
        <h3>Secure Login</h3>
        <p>Register securely and enjoy personalized mood-based music suggestions.</p>
    </div>
    <div class="card">
        <h3>Real-time Suggestions</h3>
        <p>Enjoy instant feedback and tune suggestions that enhance your feelings.</p>
    </div>
    <div class="card">
        <h3>Clean Dashboard</h3>
        <p>Track moods, manage preferences, and review your mood-music history.</p>
    </div>
</div>

<!-- How It Works -->
<div class="how-it-works">
    <h2>How MoodTune Works</h2>
    <ol>
        <li>Login or Register</li>
        <li>Let AI detect your mood</li>
        <li>Get a playlist just for you</li>
        <li>Save your favorites for later</li>
    </ol>
</div>

<!-- Popular Moods -->
<div class="mood-preview">
    <h2>Popular Moods</h2>
    <div class="mood-cards">
        {$moodCards}
    </div>
</div>

<!-- Testimonials -->
<div class="testimonials">
    <h2>What Our Users Say</h2>
    <blockquote>
        "I was feeling drained after work, and MoodTune played the most relaxing jazz I’ve ever heard.  
        It’s like it *knew* I needed to unwind." – Riya Sharma
    </blockquote>
    <blockquote>
        "I tried the mood detection out of curiosity… ended up discovering 3 new rock bands.  
        This app totally changed my playlist game." – Arjun Mehta
    </blockquote>
    <blockquote>
        "On rainy days, I just let MoodTune decide for me.  
        Last week it gave me a perfect mix of lo-fi beats and old Bollywood tracks – pure magic." – Sneha Verma
    </blockquote>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 MoodTune | <a href="about.php">About</a> | <a href="contact.php">Contact</a></p>
</footer>

<style>
/* Hero Styling */
.hero {
    background: linear-gradient(135deg, #ff4081, #4fc3f7);
    color: white;
    padding: 80px 20px;
    text-align: center;
    border-radius: 0 0 30px 30px;
}

/* CTA Buttons */
.btn-primary, .btn-secondary {
    display: inline-block;
    margin: 10px;
    padding: 12px 25px;
    font-size: 16px;
    border-radius: 30px;
    text-decoration: none;
    transition: 0.3s;
}

.btn-primary {
    background: #7e57c2;
    color: white;
    box-shadow: 0 0 10px #7e57c2;
}

.btn-primary:hover {
    box-shadow: 0 0 20px #7e57c2, 0 0 30px #ff4081;
}

.btn-secondary {
    border: 2px solid white;
    color: white;
}

.btn-secondary:hover {
    background: white;
    color: #4fc3f7;
}

/* Features Section */
.features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    padding: 40px 20px;
}

.features .card {
    background: #f8f8f8;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    transition: 0.3s;
}

.features .card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

/* How It Works */
.how-it-works {
    padding: 40px 20px;
    text-align: center;
}

.how-it-works ol {
    list-style: decimal;
    display: inline-block;
    text-align: left;
}

/* Mood Preview */
.mood-preview {
    padding: 40px 20px;
    text-align: center;
}

.mood-cards {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.mood-card {
    padding: 20px;
    border-radius: 15px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.mood-card:hover {
    transform: scale(1.1);
}

/* Testimonials */
.testimonials {
    padding: 50px 20px;
    background: linear-gradient(135deg, #ff4081, #4fc3f7);
    color: white;
    text-align: center;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    margin: 40px auto;
    max-width: 900px;
}

.testimonials h2 {
    font-size: 2rem;
    margin-bottom: 25px;
    font-weight: bold;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

.testimonials blockquote {
    background: rgba(255, 255, 255, 0.15);
    padding: 20px 25px;
    margin: 15px auto;
    border-radius: 15px;
    font-style: italic;
    font-size: 1.1rem;
    line-height: 1.6;
    max-width: 700px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.testimonials blockquote:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
}

.testimonials blockquote::before {
    content: "❝";
    font-size: 2rem;
    vertical-align: top;
    margin-right: 8px;
    color: #ffe082;
}

.testimonials blockquote::after {
    content: "❞";
    font-size: 2rem;
    vertical-align: bottom;
    margin-left: 8px;
    color: #ffe082;
}

/* Footer */
footer {
    padding: 20px;
    text-align: center;
    background: #222;
    color: white;
    border-radius: 30px 30px 0 0;
}

footer a {
    color: #4fc3f7;
    text-decoration: none;
}
</style>
EOD;

include 'base.php';
?>
