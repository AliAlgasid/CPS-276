<?php
require_once '/home/a/l/alalgasid/public_html/cps-276/Assignments/Assignment 7/classes/Db_conn.php';
require_once '/home/a/l/alalgasid/public_html/cps-276/Assignments/Assignment 7/classes/Pdo_methods.php';

$output = '<h1>File Upload</h1>';
$output .= '<a href="listFiles.php">Show File List</a><br><br>';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_FILES['pdfFile']) || $_FILES['pdfFile']['error'] !== UPLOAD_ERR_OK) {
        $output .= "Error: No file was uploaded or an upload error occurred.";
    } else {
        $fileName = trim($_POST['fileName']);
        $fileTmp = $_FILES['pdfFile']['tmp_name'];
        $fileSize = $_FILES['pdfFile']['size'];
        $fileType = mime_content_type($fileTmp);
        $fileDest = '/home/a/l/alalgasid/public_html/cps-276/Assignments/Assignment 7/files/' . basename($_FILES['pdfFile']['name']);

        if (empty($fileName)) {
            $output .= "Error: Please enter a file name.";
        } elseif ($fileSize > 100000) {
            $output .= "Error: File exceeds 100,000 bytes.";
        } elseif ($fileType !== 'application/pdf') {
            $output .= "Error: Only PDF files are allowed.";
        } elseif (!move_uploaded_file($fileTmp, $fileDest)) {
            $output .= "Error: Unable to move uploaded file.";
        } else {
            $pdo = new PdoMethods();
            $sql = "INSERT INTO files (file_name, file_path) VALUES (:file_name, :file_path)";
            $bindings = [
                [':file_name', $fileName, 'str'],
                [':file_path', $fileDest, 'str']
            ];
            $result = $pdo->otherBinded($sql, $bindings);

            if ($result === 'noerror') {
                $output .= "File uploaded successfully.";
            } else {
                $output .= "Database error: Could not record file info.";
            }
        }
    }
}

$output .= '
<form method="POST" enctype="multipart/form-data">
  <label>File Name:</label><br>
  <input type="text" name="fileName"><br><br>

  <label>Select PDF:</label><br>
  <input type="file" name="pdfFile" accept="application/pdf"><br><br>

  <input type="submit" value="Upload File">
</form>
';
