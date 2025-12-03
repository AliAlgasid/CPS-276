<?php
/* THIS CLASS EXTENDS THE DATABASE CONNECTION CLASS AND BUILDS ON IT WITH PDO COMMANDS */
require_once "Db_conn.php";

class PdoMethods extends DatabaseConn {

  private $sth;
  private $conn;
  private $db;
  private $error;

  /* SELECT WITH BINDINGS */
  public function selectBinded($sql, $bindings) {
    $this->error = false;

    try {
      $this->db_connection();
      $this->sth = $this->conn->prepare($sql);
      $this->createBinding($bindings);
      $this->sth->execute();
    }
    catch (PDOException $e) {
      echo $e->getMessage();
      return 'error';
    }

    $this->conn = null;
    return $this->sth->fetchAll(PDO::FETCH_ASSOC);
  }

  /* SELECT WITHOUT BINDINGS */
  public function selectNotBinded($sql) {
    $this->error = false;

    try {
      $this->db_connection();
      $this->sth = $this->conn->prepare($sql);
      $this->sth->execute();
    }
    catch (PDOException $e) {
      echo $e->getMessage();
      return 'error';
    }

    $this->conn = null;
    return $this->sth->fetchAll(PDO::FETCH_ASSOC);
  }

  /* INSERT UPDATE DELETE WITH BINDINGS */
  public function otherBinded($sql, $bindings) {
    $this->error = false;

    try {
      $this->db_connection();
      $this->sth = $this->conn->prepare($sql);
      $this->createBinding($bindings);
      $this->sth->execute();
    }
    catch (PDOException $e) {
      echo $e->getMessage();
      return 'error';
    }

    $this->conn = null;
    return 'noerror';
  }

  /* INSERT UPDATE DELETE WITHOUT BINDINGS */
  public function otherNotBinded($sql) {
    $this->error = false;

    try {
      $this->db_connection();
      $this->sth = $this->conn->prepare($sql);
      $this->sth->execute();
    }
    catch (PDOException $e) {
      echo $e->getMessage();
      return 'error';
    }

    $this->conn = null;
    return 'noerror';
  }

  /* CREATE CONNECTION */
  private function db_connection() {
    $this->db   = new DatabaseConn();
    $this->conn = $this->db->dbOpen();
  }

  /* CREATE BINDINGS — FIXED WITH BREAK STATEMENTS */
  private function createBinding($bindings) {
    foreach ($bindings as $value) {
      switch ($value[2]) {

        case "str":
            $this->sth->bindParam($value[0], $value[1], PDO::PARAM_STR);
            break;
        case "int":
            $this->sth->bindParam($value[0], $value[1], PDO::PARAM_INT);
            break;

      }
    }
  }
}
