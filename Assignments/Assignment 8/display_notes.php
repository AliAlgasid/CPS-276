<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $dt->getNotes($_POST);
}
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

    <form method="post" action="">
        <label for="begDate">Beginning Date:</label>
        <input type="date" name="begDate" id="begDate"><br><br>

        <label for="endDate">Ending Date:</label>
        <input type="date" name="endDate" id="endDate"><br><br>

        <input type="submit" value="Get Notes">
    </form>

    <div>
        <?php echo $message; ?>
    </div>
</body>
</html>
