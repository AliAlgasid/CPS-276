<?php
function addClearNames(){
    if (!isset($_SESSION['names'])) {
        $_SESSION['names'] = [];
    }

    if (isset($_POST['add'])) {
        $input = trim($_POST['firstname']);
        $parts = explode(" ", $input);

        if (count($parts) == 2) {
            $first = ucfirst(strtolower($parts[0]));
            $last = ucfirst(strtolower($parts[1]));
            $formatted = $last . ", " . $first;
            
            // Add the name if it’s not already in the list
            $_SESSION['names'][] = $formatted;

            // Sort names alphabetically
            sort($_SESSION['names']);
        }
    }

    if (isset($_POST['clear'])) {
        $_SESSION['names'] = [];
    }

    return implode("\n", $_SESSION['names']);
}
?>
