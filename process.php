<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['image'])) {
    echo json_encode(['error' => 'No image provided']);
    exit;
}

// Save base64 image to file
$image_data = $data['image'];
$image_data = str_replace('data:image/jpeg;base64,', '', $image_data);
$image_data = base64_decode($image_data);
$file_path = 'captured.jpg';
file_put_contents($file_path, $image_data);

// Run Python script
$cmd = escapeshellcmd("python3 detect_mood.py " . $file_path);
$output = shell_exec($cmd);
$result = json_decode($output, true);

// Return mood + song
echo json_encode($result);
?>
