<?php
$output = "";
$acknowledgement = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'php/rest_client.php';
    $result = getWeather();
    $acknowledgement = $result[0];
    $output = $result[1];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>City Weather Lookup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body style="background:#ffcc00;">
<div class="container bg-white mt-3 mb-3 p-4">
    <h1>Enter Zip Code to Get City Weather</h1>

    <?php echo $acknowledgement; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="zip_code" class="form-label">Zip Code:</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <hr>

    <?php echo $output; ?>
</div>
</body>
</html>
