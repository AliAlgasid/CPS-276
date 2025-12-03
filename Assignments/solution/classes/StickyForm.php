<?php

class StickyForm {

    public function stickyText($field) {
        return isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : "";
    }

    public function stickySelect($field, $value) {
        if (!isset($_POST[$field])) return "";
        return $_POST[$field] == $value ? "selected" : "";
    }

    public function stickyRadio($field, $value) {
        if (!isset($_POST[$field])) return "";
        return $_POST[$field] == $value ? "checked" : "";
    }

    public function stickyCheck($field, $value) {
        if (!isset($_POST[$field])) return "";
        return in_array($value, $_POST[$field]) ? "checked" : "";
    }

    public function error($field) {
        return isset($_SESSION["errors"][$field]) ? $_SESSION["errors"][$field] : "";
    }

}

