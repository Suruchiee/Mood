<?php
$host = '127.0.0.1';
$db = 'mood_db';
$user = 'root';
$pass = 'root';

$conn = new mysqli($host, $user, $pass, $db, 8889);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>