<?php
require_once "classes/Pdo_methods.php";
require_once "classes/Validation.php";

function addContactProc() {

    if (!isset($_POST["submit"])) return "";

    $pdo = new PdoMethods();
    $valid = new Validation();
    $errors = [];

    $errors["fname"]   = $valid->checkName($_POST["fname"]);
    $errors["lname"]   = $valid->checkName($_POST["lname"]);
    $errors["address"] = $valid->checkAddress($_POST["address"]);
    $errors["city"]    = $valid->checkCity($_POST["city"]);
    $errors["phone"]   = $valid->checkPhone($_POST["phone"]);
    $errors["email"]   = $valid->checkEmail($_POST["email"]);
    $errors["dob"]     = $valid->checkDob($_POST["dob"]);

    $errors["age"] = (!isset($_POST["age"]) || $_POST["age"] === "")
        ? "You must select an age range."
        : "";

    $hasError = false;
    foreach ($errors as $e) {
        if ($e != "") $hasError = true;
    }

    if ($hasError) {
        $_SESSION["errors"] = $errors;
        return "";
    }

    $contacts = isset($_POST["contacts"])
        ? implode(", ", $_POST["contacts"])
        : "";

    $sql = "INSERT INTO contacts 
            (fname, lname, address, city, state, phone, email, dob, contacts, age)
            VALUES 
            (:fname, :lname, :address, :city, :state, :phone, :email, :dob, :contacts, :age)";

    $result = $pdo->otherBinded($sql, [
        [":fname", $_POST["fname"], "str"],
        [":lname", $_POST["lname"], "str"],
        [":address", $_POST["address"], "str"],
        [":city",   $_POST["city"],   "str"],
        [":state",  $_POST["state"],  "str"],
        [":phone",  $_POST["phone"],  "str"],
        [":email",  $_POST["email"],  "str"],
        [":dob",    $_POST["dob"],    "str"],
        [":contacts", $contacts,      "str"],
        [":age",    $_POST["age"],    "str"]
    ]);

    if ($result == "error") {
        return "<p class='text-danger'>There was an error adding the record.</p>";
    }

    $_POST = [];
    $_SESSION["errors"] = [];

    return "<p class='text-success'>Contact Information Added</p>";
}

