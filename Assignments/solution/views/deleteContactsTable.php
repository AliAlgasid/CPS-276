<?php
require_once "includes/navigation.php";
require_once "controllers/deleteContactProc.php";
require_once "classes/Pdo_methods.php";

$output = deleteContactProc();
$pdo = new PdoMethods();
$records = $pdo->selectNotBinded("SELECT * FROM contacts");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Delete Contacts</h2>
<?php echo navigation(); ?>
<?php echo $output; ?>

<?php if ($records == "error" || count($records) == 0): ?>
<p>There are no records to display</p>
<?php else: ?>

<form method="post" action="index.php?page=deleteContacts">

<table class="table table-bordered">
<tr>
<th>First</th><th>Last</th><th>Email</th><th>Delete</th>
</tr>

<?php
foreach ($records as $r) {
    echo "<tr>
            <td>{$r["fname"]}</td>
            <td>{$r["lname"]}</td>
            <td>{$r["email"]}</td>
            <td><input type='checkbox' name='ids[]' value='{$r["id"]}'></td>
          </tr>";
}
?>
</table>

<button type="submit" name="delete" class="btn btn-danger">Delete Selected</button>

</form>

<?php endif; ?>

</body>
</html>
