<?php
class Directories {
    public function createDirectoryAndFile($dirName, $fileContent) {
        if (!preg_match('/^[A-Za-z]+$/', $dirName)) {
            return "Error: Directory name must contain only alphabetic characters.";
        }

        $dirPath = "directories/$dirName";

        if (is_dir($dirPath)) {
            return "A directory already exists with that name.";
        }

        if (!mkdir($dirPath, 0777, true)) {
            return "Error: Directory could not be created.";
        }

        $filePath = "$dirPath/readme.txt";
        if (file_put_contents($filePath, $fileContent) === false) {
            return "Error: File could not be created.";
        }

        $fileLink = "directories/$dirName/readme.txt";
        return "Path where the file is located: <a href='$fileLink' target='_blank'>$fileLink</a>";
    }
}
?>
