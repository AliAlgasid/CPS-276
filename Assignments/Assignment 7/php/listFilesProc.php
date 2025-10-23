<?php
require_once '/home/a/l/alalgasid/public_html/cps-276/Assignments/Assignment 7/classes/Db_conn.php';
require_once '/home/a/l/alalgasid/public_html/cps-276/Assignments/Assignment 7/classes/Pdo_methods.php';

$output = '<h1>List Files</h1>';
$output .= '<a href="index.php">Add File</a><br><br>';

$pdo = new PdoMethods();
$sql = "SELECT file_name, file_path FROM files";
$records = $pdo->selectNotBinded($sql);

if ($records === 'error' || empty($records)) {
    $output .= 'No files found.';
} else {
    $output .= '<ul>';
    foreach ($records as $row) {
        $relativePath = str_replace('/home/a/l/alalgasid/public_html/cps-276/Assignments/Assignment 7/', '', $row['file_path']);
        $output .= '<li><a target="_blank" href="' . $relativePath . '">' . htmlspecialchars($row['file_name']) . '</a></li>';
    }
    $output .= '</ul>';
}
?>
