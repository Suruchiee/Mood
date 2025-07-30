<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = escapeshellarg($_POST["user_input"]);
    $command = "bash -c 'source venv/bin/activate && python3 predict.py $input'";
    $output = shell_exec($command);
    echo trim($output);
}
?>
