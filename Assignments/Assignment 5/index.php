<?php
require_once 'classes/Directories.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dirName = $_POST['dirname'] ?? '';
    $fileContent = $_POST['filecontent'] ?? '';
    $dirHandler = new Directories();
    $message = $dirHandler->createDirectoryAndFile($dirName, $fileContent);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment 5</title>
</head>
<body>
    <h2>Create Directory and File</h2>
    <form method="post">
        <label>Directory Name:</label>
        <input type="text" name="dirname" required><br><br>
        <label>File Content:</label><br>
        <textarea name="filecontent" rows="5" cols="40" required></textarea><br><br>
        <button type="submit">Submit</button>
    </form>
    <p><?php echo $message; ?></p>
</body>
</html>
