<?php

class Validation {

  public function checkName($name) {
    return preg_match("/^[A-Za-z' ]+$/", $name);
  }

  public function checkEmail($email) {
    return preg_match("/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/", $email);
  }

  public function checkPassword($password) {
    return preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=\[\]{};:'\",.<>\/?]).{8,}$/", $password);
  }

  public function matchPasswords($password, $confirm) {
    return $password === $confirm;
  }
}
