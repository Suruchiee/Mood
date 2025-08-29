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
    <title>Mood Detection</title>
    <style>
        body {
            background-color: #1c1c1c;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }
        video {
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        }
        .msg {
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<h2>Scanning Your Mood 🎥</h2>
<video id="video" width="640" height="480" autoplay></video>
<div class="msg" id="statusMsg">Please look at the camera for 3 seconds...</div>

<script>
    // Access webcam
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            document.getElementById('video').srcObject = stream;

            // Capture after 3 seconds
            setTimeout(() => {
                captureFrame();
            }, 3000);
        })
        .catch(err => {
            document.getElementById('statusMsg').innerText = "Camera access denied!";
        });

    function captureFrame() {
        const video = document.getElementById('video');
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0);

        // Convert image to base64
        const imageData = canvas.toDataURL('image/jpeg');

        // Send to backend
        fetch('process_mood.php', {
            method: 'POST',
            body: JSON.stringify({ image: imageData }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            // Redirect back to dashboard with mood
            window.location.href = "dashboard.php?mood=" + encodeURIComponent(data.mood) + "&song=" + encodeURIComponent(data.song);
        })
        .catch(err => {
            document.getElementById('statusMsg').innerText = "Error detecting mood.";
        });
    }
</script>

</body>
</html>
