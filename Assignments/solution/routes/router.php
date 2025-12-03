<?php
session_start();

require_once "includes/security.php";

$page = isset($_GET["page"]) ? $_GET["page"] : "login";

$valid = [
    "login",
    "welcome",
    "addContact",
    "deleteContacts",
    "addAdmin",
    "deleteAdmins"
];

if (!in_array($page, $valid)) {
    header("Location: index.php?page=login");
    exit;
}

if ($page != "login") {
    protect($page);
}

switch ($page) {
    case "login":
        require_once "views/loginForm.php";
        break;

    case "welcome":
        require_once "views/welcome.php";
        break;

    case "addContact":
        require_once "views/addContactForm.php";
        break;

    case "deleteContacts":
        require_once "views/deleteContactsTable.php";
        break;

    case "addAdmin":
        require_once "views/addAdminForm.php";
        break;

    case "deleteAdmins":
        require_once "views/deleteAdminsTable.php";
        break;
}
