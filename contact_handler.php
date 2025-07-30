<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // For now, just display the input (you can later insert into DB or send an email)
    echo "<h2>Thank You, $name!</h2>";
    echo "<p>We have received your message:</p>";
    echo "<strong>Subject:</strong> $subject<br>";
    echo "<strong>Email:</strong> $email<br>";
    echo "<strong>Message:</strong><br><pre>$message</pre>";
}
?>
