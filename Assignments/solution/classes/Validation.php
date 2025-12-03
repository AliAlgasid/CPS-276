<?php

class Validation {

    public function checkName($value) {
        $pattern = "/^[A-Za-z' -]+$/";
        if ($value == "") {
            return "This field cannot be blank.";
        }
        elseif (!preg_match($pattern, $value)) {
            return "Only letters, spaces, hyphens, and apostrophes are allowed.";
        }
        return "";
    }

    public function checkAddress($value) {
        $pattern = "/^[0-9]+\s+[A-Za-z0-9\s]+$/";
        if ($value == "") {
            return "Address cannot be blank.";
        }
        elseif (!preg_match($pattern, $value)) {
            return "Address must start with a number followed by the street name.";
        }
        return "";
    }

    public function checkCity($value) {
        $pattern = "/^[A-Za-z ]+$/";
        if ($value == "") {
            return "City cannot be blank.";
        }
        elseif (!preg_match($pattern, $value)) {
            return "City must contain only letters.";
        }
        return "";
    }

    public function checkPhone($value) {
        $pattern = "/^[0-9]{3}\.[0-9]{3}\.[0-9]{4}$/";
        if ($value == "") {
            return "Phone number cannot be blank.";
        }
        elseif (!preg_match($pattern, $value)) {
            return "Phone must be in the format 999.999.9999.";
        }
        return "";
    }

    public function checkEmail($value) {
        if ($value == "") {
            return "Email cannot be blank.";
        }
        elseif (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }
        return "";
    }

    public function checkDOB($value) {
        $pattern = "/^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/(19|20)\d\d$/";

        if ($value == "") {
            return "DOB cannot be blank.";
        }
        elseif (!preg_match($pattern, $value)) {
            return "DOB must be in the format mm/dd/yyyy.";
        }
        return "";
    }

    public function checkPassword($value) {
        $pattern = "/^[A-Za-z0-9!@#$%^&*()_\-+=\[\]{};:'\",.<>\/?]+$/";

        if ($value == "") {
            return "Password cannot be blank.";
        }
        elseif (!preg_match($pattern, $value)) {
            return "Password can only contain letters, numbers, and special characters.";
        }
        return "";
    }

    public function checkAgeSelection($value) {
        if ($value == "") {
            return "You must select an age range.";
        }
        return "";
    }
}

