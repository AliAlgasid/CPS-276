<?php
require_once "controllers/addAdminProc.php";
require_once "classes/StickyForm.php";
require_once "includes/navigation.php";


$output = addAdminProc();
$form = new StickyForm();
$statuses = ["staff","admin"];
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Add Admin</h2>
<?php echo navigation(); ?>
<?php echo $output; ?>

<form method="post" action="index.php?page=addAdmin" class="mt-3">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" value="<?php echo $form->stickyText("name"); ?>">
<div class="text-danger"><?php echo $form->error("name"); ?></div>
</div>

<div class="mb-3">
<label>Email</label>
<input type="text" name="email" class="form-control" value="<?php echo $form->stickyText("email"); ?>">
<div class="text-danger"><?php echo $form->error("email"); ?></div>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control">
<div class="text-danger"><?php echo $form->error("password"); ?></div>
</div>

<div class="mb-3">
<label>Status</label>
<select name="status" class="form-control">
<option value="">Select</option>
<?php
foreach ($statuses as $s) {
    $sel = $form->stickySelect("status", $s);
    echo "<option value='$s' $sel>$s</option>";
}
?>
</select>
<div class="text-danger"><?php echo $form->error("status"); ?></div>
</div>

<button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>

</body>
</html>
