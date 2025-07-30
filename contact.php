<?php
$pageTitle = "MoodTune - Contact Us";

$content = <<<EOD
<div class="contact-container">
    <h1>Contact Us</h1>
    <p>Have questions, feedback, or just want to say hello? We'd love to hear from you. Fill out the form below and we'll get back to you shortly.</p>

    <form method="POST" action="contact_handler.php">
        <input type="text" name="name" placeholder="Your Full Name" required>
        <input type="email" name="email" placeholder="Your Email Address" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <textarea name="message" placeholder="Your Message..." required></textarea>
        <input type="submit" value="Send Message">
    </form>
</div>
EOD;

include_once "base.php";
?>
