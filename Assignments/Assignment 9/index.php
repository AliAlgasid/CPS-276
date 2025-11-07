<?php
require_once "classes/Pdo_methods.php";
require_once "classes/StickyForm.php";

$stickyForm = new StickyForm();
$pdo = new PdoMethods();
$message = "";

if (isset($_POST['submit'])) {
  if ($stickyForm->validateForm($_POST)) {
    $email = $stickyForm->formConfig["fields"]["email"]["value"];
    $sql = "SELECT * FROM users WHERE email = :email";
    $bindings = [
      [":email", $email, "str"]
    ];
    $records = $pdo->selectBinded($sql, $bindings);

    if ($records && count($records) > 0) {
      $stickyForm->formConfig["fields"]["email"]["error"] = "Email already exists";
      $stickyForm->formConfig["masterStatus"]["error"] = true;
    } else {
      $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first, :last, :email, :password)";
      $bindings = [
        [":first", $stickyForm->formConfig["fields"]["firstName"]["value"], "str"],
        [":last", $stickyForm->formConfig["fields"]["lastName"]["value"], "str"],
        [":email", $stickyForm->formConfig["fields"]["email"]["value"], "str"],
        [":password", password_hash($stickyForm->formConfig["fields"]["password"]["value"], PASSWORD_DEFAULT), "str"]
      ];
      $result = $pdo->otherBinded($sql, $bindings);
      if ($result === "noerror") {
        $message = "<p class='success'>User added successfully.</p>";
        foreach ($stickyForm->formConfig["fields"] as $key => $field) {
          $stickyForm->formConfig["fields"][$key]["value"] = "";
          $stickyForm->formConfig["fields"][$key]["error"] = "";
        }
        $stickyForm->formConfig["masterStatus"]["error"] = false;
      }
    }
  }
}

$sql = "SELECT * FROM users";
$users = $pdo->selectNotBinded($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
  <style>
    form { width: 300px; margin: 20px; }
    input { display: block; margin-bottom: 10px; width: 100%; padding: 5px; }
    span { color: red; font-size: 0.9em; }
    table { border-collapse: collapse; width: 90%; margin: 20px; }
    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    .success { color: green; }
  </style>
</head>
<body>
  <h2>User Registration</h2>
  <form method="post" action="">
    <label>First Name</label>
    <input type="text" name="firstName" value="<?= htmlspecialchars($stickyForm->formConfig['fields']['firstName']['value']) ?>">
    <span><?= $stickyForm->formConfig['fields']['firstName']['error'] ?></span>

    <label>Last Name</label>
    <input type="text" name="lastName" value="<?= htmlspecialchars($stickyForm->formConfig['fields']['lastName']['value']) ?>">
    <span><?= $stickyForm->formConfig['fields']['lastName']['error'] ?></span>

    <label>Email</label>
    <input type="text" name="email" value="<?= htmlspecialchars($stickyForm->formConfig['fields']['email']['value']) ?>">
    <span><?= $stickyForm->formConfig['fields']['email']['error'] ?></span>

    <label>Password</label>
    <input type="password" name="password" value="<?= htmlspecialchars($stickyForm->formConfig['fields']['password']['value']) ?>">
    <span><?= $stickyForm->formConfig['fields']['password']['error'] ?></span>

    <label>Confirm Password</label>
    <input type="password" name="confirmPassword" value="<?= htmlspecialchars($stickyForm->formConfig['fields']['confirmPassword']['value']) ?>">
    <span><?= $stickyForm->formConfig['fields']['confirmPassword']['error'] ?></span>

    <input type="submit" name="submit" value="Register">
  </form>

  <?= $message ?>

  <?php if ($users && count($users) > 0): ?>
  <h3>Registered Users</h3>
  <table>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Password</th>
    </tr>
    <?php foreach ($users as $u): ?>
    <tr>
      <td><?= htmlspecialchars($u['first_name']) ?></td>
      <td><?= htmlspecialchars($u['last_name']) ?></td>
      <td><?= htmlspecialchars($u['email']) ?></td>
      <td><?= htmlspecialchars($u['password']) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php endif; ?>
</body>
</html>
