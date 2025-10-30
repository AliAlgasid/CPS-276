<?php
require_once 'Db_conn.php';

class PdoMethods {

    public function selectBinded($sql, $bindings) {
        $db = new DatabaseConn();
        $pdo = $db->dbOpen();
        $stmt = $pdo->prepare($sql);
        try {
            foreach ($bindings as $binding) {
                $stmt->bindValue($binding[0], $binding[1], $this->getType($binding[2]));
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 'error';
        }
    }

    public function otherBinded($sql, $bindings) {
        $db = new DatabaseConn();
        $pdo = $db->dbOpen();
        $stmt = $pdo->prepare($sql);
        try {
            foreach ($bindings as $binding) {
                $stmt->bindValue($binding[0], $binding[1], $this->getType($binding[2]));
            }
            $stmt->execute();
            return 'noerror';
        } catch (PDOException $e) {
            return 'error';
        }
    }

    private function getType($type) {
        switch ($type) {
            case 'int':
                return PDO::PARAM_INT;
            case 'bool':
                return PDO::PARAM_BOOL;
            case 'null':
                return PDO::PARAM_NULL;
            default:
                return PDO::PARAM_STR;
        }
    }
}
?>
