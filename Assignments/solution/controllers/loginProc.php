<?php
require_once "classes/Pdo_methods.php";
require_once "classes/StickyForm.php";
require_once "classes/Validation.php";

function loginProc() {
    if (!isset($_POST["submit"])) return "";

    $pdo = new PdoMethods();
    $valid = new Validation();

    $email = $_POST["email"];
    $password = $_POST["password"];


    if ($email == "" || $password == "") {
        return "<p class='text-danger'>Email and password are required.</p>";
    }

    $sql = "SELECT * FROM admins WHERE email = :email";
    $records = $pdo->selectBinded($sql, [
        [":email", $email, "str"]
    ]);

    if ($records == "error") {
    return "<p class='text-danger'>DB error.</p>";
    }

    if (count($records) == 0) {
    return "<p class='text-danger'>No user found.</p>";
    }

    $user = $records[0];

    if (!password_verify($password, $user["password"])) {
    return "<p class='text-danger'>Password mismatch.</p>";
    }



    $_SESSION["status"] = $user["status"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["email"] = $user["email"];

    header("Location: index.php?page=welcome");
    exit;
}
