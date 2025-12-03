<?php
require_once "classes/Pdo_methods.php";

function deleteAdminProc() {
    if (!isset($_POST["delete"])) return "";

    if (!isset($_POST["ids"])) return "";

    $pdo = new PdoMethods();
    $ids = $_POST["ids"];

    $sql = "DELETE FROM admins WHERE id = :id";

    foreach ($ids as $id) {
        $result = $pdo->otherBinded($sql, [
            [":id", $id, "int"]
        ]);
        if ($result == "error") {
            return "<p class='text-danger'>Could not delete the admins.</p>";
        }
    }

    return "<p class='text-success'>Admin(s) deleted</p>";
}
