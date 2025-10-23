<?php
require_once '/home/a/l/alalgasid/public_html/cps-276/Assignments/Assignment 7/classes/Db_conn.php';

class PdoMethods extends DatabaseConn {
    private $conn;

    public function __construct() {
        $this->conn = $this->dbOpen();
    }

    public function selectNotBinded($sql) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function otherBinded($sql, $bindings) {
        $stmt = $this->conn->prepare($sql);
        foreach ($bindings as $bind) {
            $stmt->bindValue($bind[0], $bind[1], PDO::PARAM_STR);
        }
        if ($stmt->execute()) {
            return 'noerror';
        } else {
            return 'error';
        }
    }
}
?>


