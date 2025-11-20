<?php
header("Content-Type: application/json");

require "../classes/Pdo_methods.php";
$pdo = new PdoMethods();

$sql = "SELECT name FROM names ORDER BY name ASC";
$result = $pdo->selectNotBinded($sql);

if ($result === "error") {
    echo json_encode(["masterstatus" => "error", "msg" => "Could not load names"]);
    exit;
}

$formatted = "";
foreach ($result as $row) {
    $formatted .= $row["name"] . "<br>";
}

echo json_encode([
    "masterstatus" => "success",
    "names" => $formatted,
    "msg" => ""
]);
?>
