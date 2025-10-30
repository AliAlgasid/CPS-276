<?php
require_once 'Pdo_methods.php';

class Date_time {

    public function checkSubmit() {
        if (isset($_POST['addNote'])) {
            return $this->addNote();
        }
        if (isset($_POST['getNotes'])) {
            return $this->getNotes();
        }
    }

    private function addNote() {
        $pdo = new PdoMethods();

        if (empty($_POST['dateTime']) || empty($_POST['note'])) {
            return '<p style="color:red;">You must enter a date, time, and note.</p>';
        }

        $timestamp = strtotime($_POST['dateTime']);
        $sql = "INSERT INTO note (date_time, note) VALUES (:date_time, :note)";
        $bindings = [
            [':date_time', $timestamp, 'int'],
            [':note', $_POST['note'], 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result == 'noerror') {
            header("Location: display_notes.php");
            exit();
        } else {
            return '<p style="color:red;">Error adding note.</p>';
        }
    }

    public function showAllNotes() {
        $pdo = new PdoMethods();

        $sql = "SELECT date_time, note FROM note ORDER BY date_time DESC";
        $records = $pdo->selectBinded($sql, []);

        if ($records == 'error' || empty($records)) {
            return '<p style="color:red;">No notes found.</p>';
        }

        $table = '<table border="1" cellpadding="5" style="border-collapse:collapse;"><tr><th>Date and Time</th><th>Note</th></tr>';
        foreach ($records as $row) {
            $date = date("m/d/Y h:i A", $row['date_time']);
            $table .= "<tr><td>{$date}</td><td>{$row['note']}</td></tr>";
        }
        $table .= '</table>';
        return $table;
    }
}
?>
