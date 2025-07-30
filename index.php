<?php
$pageTitle = "Welcome to MoodTune";

$content = <<<EOD
<div class="hero">
    <h1>Welcome to MoodTune</h1>
    <p>Let your emotions decide your playlist. Discover music based on your mood!</p>
</div>

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
EOD;

include 'base.php';
?>