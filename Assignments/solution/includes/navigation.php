<?php

function navigation() {
    if (!isset($_SESSION["status"])) return "";

    if ($_SESSION["status"] == "staff") {
        return "
        <nav>
            <a href='index.php?page=addContact'>Add Contact</a>
            <a href='index.php?page=deleteContacts'>Delete Contact(s)</a>
            <a href='logout.php'>Logout</a>
        </nav>
        ";
    }

    if ($_SESSION["status"] == "admin") {
        return "
        <nav>
            <a href='index.php?page=addContact'>Add Contact</a>
            <a href='index.php?page=deleteContacts'>Delete Contact(s)</a>
            <a href='index.php?page=addAdmin'>Add Admin</a>
            <a href='index.php?page=deleteAdmins'>Delete Admin(s)</a>
            <a href='logout.php'>Logout</a>
        </nav>
        ";
    }
}
