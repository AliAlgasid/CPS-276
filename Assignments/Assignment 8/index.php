<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$message = $dt->checkSubmit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Note</title>
</head>
<body>
    <h1>Add a Note</h1>
    <?php echo $message ?? ''; ?>
    <form method="post" action="">
        <label for="dateTime">Date and Time:</label><br>
        <input type="datetime-local" id="dateTime" name="dateTime"><br><br>

        <label for="note">Note:</label><br>
        <textarea id="note" name="note" rows="5" cols="40"></textarea><br><br>

        <input type="submit" name="addNote" value="Add Note">
    </form>

    <p><a href="display_notes.php">View Notes</a></p>
</body>
</html>
