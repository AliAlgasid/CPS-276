<?php
header("Content-Type: application/json");

require "../classes/Pdo_methods.php";
$pdo = new PdoMethods();

$result = $pdo->otherNotBinded("DELETE FROM names");

echo json_encode([
    "masterstatus" => $result === "error" ? "error" : "success",
    "msg" => $result === "error" ? "Could not clear names" : "Names cleared"
]);
