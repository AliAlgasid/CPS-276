<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$message = $dt->showAllNotes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Notes</title>
</head>
<body>
    <h1>Display Notes</h1>
    <p><a href="index.php">Add Note</a></p>
    <?php echo $message ?? ''; ?>
</body>
</html>
