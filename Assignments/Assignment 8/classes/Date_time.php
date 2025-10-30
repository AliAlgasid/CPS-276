<?php
require_once 'Pdo_methods.php';

class Date_time {

    public function checkSubmit() {
        if (isset($_POST['dateTime']) && isset($_POST['note'])) {
            if ($_POST['dateTime'] == '' || $_POST['note'] == '') {
                return '<p style="color:red;">You must enter a date, time, and note.</p>';
            } else {
                return $this->addNote();
            }
        }
    }

    private function addNote() {
        $pdo = new PdoMethods();

        $timestamp = strtotime($_POST['dateTime']);
        $sql = "INSERT INTO note (date_time, note) VALUES (:date_time, :note)";
        $bindings = [
            [':date_time', $timestamp, 'int'],
            [':note', $_POST['note'], 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'error') {
            return '<p style="color:red;">Error adding note.</p>';
        } else {
            return '<p style="color:green;">Note added successfully.</p>';
        }
    }

    public function getNotes($post) {
        if ($post['begDate'] == '' || $post['endDate'] == '') {
            return '<p style="color:red;">You must enter both a beginning and an ending date.</p>';
        }

        $pdo = new PdoMethods();

        $begDate = strtotime($post['begDate'] . ' 00:00:00');
        $endDate = strtotime($post['endDate'] . ' 23:59:59');

        $sql = "SELECT date_time, note FROM note WHERE date_time BETWEEN :begDate AND :endDate ORDER BY date_time DESC";
        $bindings = [
            [':begDate', $begDate, 'int'],
            [':endDate', $endDate, 'int']
        ];

        $records = $pdo->selectBinded($sql, $bindings);

        if ($records == 'error' || empty($records)) {
            return '<p style="color:red;">No notes found for the date range selected.</p>';
        }

        $table = '<table border="1" cellpadding="5"><tr><th>Date and Time</th><th>Note</th></tr>';
        foreach ($records as $row) {
            $date = date("m/d/Y h:i A", $row['date_time']);
            $table .= "<tr><td>{$date}</td><td>{$row['note']}</td></tr>";
        }
        $table .= '</table>';
        return $table;
    }
}
?>
