<?php
require_once "Validation.php";

class StickyForm extends Validation {

  public $formConfig = [
    "masterStatus" => ["error" => false],
    "fields" => [
      "firstName" => ["value" => "", "error" => ""],
      "lastName" => ["value" => "", "error" => ""],
      "email" => ["value" => "", "error" => ""],
      "password" => ["value" => "", "error" => ""],
      "confirmPassword" => ["value" => "", "error" => ""]
    ]
  ];

  public function validateForm($postData) {
    foreach ($this->formConfig["fields"] as $key => $field) {
      $this->formConfig["fields"][$key]["value"] = trim($postData[$key] ?? "");
    }

    if (!$this->checkName($this->formConfig["fields"]["firstName"]["value"])) {
      $this->formConfig["fields"]["firstName"]["error"] = "Invalid first name";
      $this->formConfig["masterStatus"]["error"] = true;
    }

    if (!$this->checkName($this->formConfig["fields"]["lastName"]["value"])) {
      $this->formConfig["fields"]["lastName"]["error"] = "Invalid last name";
      $this->formConfig["masterStatus"]["error"] = true;
    }

    if (!$this->checkEmail($this->formConfig["fields"]["email"]["value"])) {
      $this->formConfig["fields"]["email"]["error"] = "Invalid email address";
      $this->formConfig["masterStatus"]["error"] = true;
    }

    if (!$this->checkPassword($this->formConfig["fields"]["password"]["value"])) {
      $this->formConfig["fields"]["password"]["error"] = "Password must be at least 8 characters with 1 uppercase, 1 symbol, and 1 number";
      $this->formConfig["masterStatus"]["error"] = true;
    }

    if (!$this->matchPasswords(
      $this->formConfig["fields"]["password"]["value"],
      $this->formConfig["fields"]["confirmPassword"]["value"]
    )) {
      $this->formConfig["fields"]["confirmPassword"]["error"] = "Passwords do not match";
      $this->formConfig["masterStatus"]["error"] = true;
    }

    return !$this->formConfig["masterStatus"]["error"];
  }
}

