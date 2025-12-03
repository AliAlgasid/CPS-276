<?php

function protect($page) {
    if (!isset($_SESSION["status"])) {
        header("Location: index.php?page=login");
        exit;
    }

    $adminsOnly = ["addAdmin", "deleteAdmins"];

    if ($_SESSION["status"] == "staff" && in_array($page, $adminsOnly)) {
        header("Location: index.php?page=login");
        exit;
    }
}
