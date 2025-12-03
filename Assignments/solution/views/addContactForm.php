<?php
require_once "controllers/addContactProc.php";
require_once "classes/StickyForm.php";
require_once "includes/navigation.php";

$output = addContactProc();
$form = new StickyForm();
$states = ["MI","OH","IN","IL","WI"];
$contacts = ["Email","Phone","Mail"];
$ages = ["18-25","26-35","36-50","51+"];
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Add Contact</h2>
<?php echo navigation(); ?>
<?php echo $output; ?>

<form method="post" action="index.php?page=addContact" class="mt-3">

<div class="mb-3">
<label>First Name</label>
<input type="text" name="fname" class="form-control" value="<?php echo $form->stickyText("fname"); ?>">
<div class="text-danger"><?php echo $form->error("fname"); ?></div>
</div>

<div class="mb-3">
<label>Last Name</label>
<input type="text" name="lname" class="form-control" value="<?php echo $form->stickyText("lname"); ?>">
<div class="text-danger"><?php echo $form->error("lname"); ?></div>
</div>

<div class="mb-3">
<label>Address</label>
<input type="text" name="address" class="form-control" value="<?php echo $form->stickyText("address"); ?>">
<div class="text-danger"><?php echo $form->error("address"); ?></div>
</div>

<div class="mb-3">
<label>City</label>
<input type="text" name="city" class="form-control" value="<?php echo $form->stickyText("city"); ?>">
<div class="text-danger"><?php echo $form->error("city"); ?></div>
</div>

<div class="mb-3">
<label>State</label>
<select name="state" class="form-control">
<option value="">Select</option>
<?php
foreach ($states as $s) {
    $sel = $form->stickySelect("state", $s);
    echo "<option value='$s' $sel>$s</option>";
}
?>
</select>
<div class="text-danger"><?php echo $form->error("state"); ?></div>
</div>

<div class="mb-3">
<label>Phone (999.999.9999)</label>
<input type="text" name="phone" class="form-control" value="<?php echo $form->stickyText("phone"); ?>">
<div class="text-danger"><?php echo $form->error("phone"); ?></div>
</div>

<div class="mb-3">
<label>Email</label>
<input type="text" name="email" class="form-control" value="<?php echo $form->stickyText("email"); ?>">
<div class="text-danger"><?php echo $form->error("email"); ?></div>
</div>

<div class="mb-3">
<label>DOB (mm/dd/yyyy)</label>
<input type="text" name="dob" class="form-control" value="<?php echo $form->stickyText("dob"); ?>">
<div class="text-danger"><?php echo $form->error("dob"); ?></div>
</div>

<div class="mb-3">
<label>Preferred Contact Method</label><br>
<?php
foreach ($contacts as $c) {
    $check = $form->stickyCheck("contacts", $c);
    echo "<input type='checkbox' name='contacts[]' value='$c' $check> $c ";
}
?>
</div>

<div class="mb-3">
<label>Age Range</label><br>
<?php
foreach ($ages as $a) {
    $r = $form->stickyRadio("age", $a);
    echo "<input type='radio' name='age' value='$a' $r> $a ";
}
?>
<div class="text-danger"><?php echo $form->error("age"); ?></div>
</div>

<button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>

</body>
</html>
