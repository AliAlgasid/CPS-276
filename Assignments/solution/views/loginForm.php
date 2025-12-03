<?php
require_once "controllers/loginProc.php";
$message = loginProc();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<div class="container" style="max-width:400px;">
<h2>Login</h2>
<?php echo $message; ?>

<form method="post" action="index.php?page=login">
    <div class="mb-3">
        <label>Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Login</button>
</form>
</div>

</body>
</html>
