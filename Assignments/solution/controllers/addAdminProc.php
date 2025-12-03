<?php
require_once "classes/Pdo_methods.php";
require_once "classes/Validation.php";

function addAdminProc() {
    if (!isset($_POST["submit"])) return "";

    $valid = new Validation();
    $pdo = new PdoMethods();

    $errors = [];

    $errors["name"] = $valid->checkName($_POST["name"]);
    $errors["email"] = $valid->checkEmail($_POST["email"]);
    $errors["password"] = $valid->checkPassword($_POST["password"]);
    $errors["status"] = $_POST["status"] == "" ? "Status is required." : "";

    $hasError = false;
    foreach ($errors as $e) {
        if ($e != "") $hasError = true;
    }

    if ($hasError) return "";

    $sql = "SELECT id FROM admins WHERE email = :email";
    $dupe = $pdo->selectBinded($sql, [
        [":email", $_POST["email"], "str"]
    ]);

    if ($dupe != "error" && count($dupe) > 0) {
        return "<p class='text-danger'>Email already exists.</p>";
    }

    $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO admins (name, email, password, status)
            VALUES (:name, :email, :password, :status)";

    $result = $pdo->otherBinded($sql, [
        [":name", $_POST["name"], "str"],
        [":email", $_POST["email"], "str"],
        [":password", $hash, "str"],
        [":status", $_POST["status"], "str"]
    ]);

    if ($result == "error") return "<p class='text-danger'>There was an error adding the admin.</p>";

    foreach ($_POST as $k => $v) $_POST[$k] = "";

    return "<p class='text-success'>Admin Added</p>";
}
