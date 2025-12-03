<?php
require_once "includes/navigation.php";
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Welcome <?php echo $_SESSION["name"]; ?></h2>

<?php echo navigation(); ?>

</body>
</html>
