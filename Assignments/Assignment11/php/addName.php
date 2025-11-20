<?php
header("Content-Type: application/json");

require "../classes/Pdo_methods.php";

$pdo = new PdoMethods();

$raw = file_get_contents("php://input");
$input = json_decode($raw, true);

if (!$input || !isset($input["name"])) {
    echo json_encode([
        "masterstatus" => "error",
        "msg" => "No name received"
    ]);
    exit;
}

$full = trim($input["name"]);
$parts = preg_split("/\s+/", $full);

if (count($parts) < 2) {
    echo json_encode([
        "masterstatus" => "error",
        "msg" => "Enter first and last name"
    ]);
    exit;
}

$first = $parts[0];
$last = $parts[1];
$final = $last . ", " . $first;

$sql = "INSERT INTO names (name) VALUES (:n)";
$bindings = [
    [":n", $final, "str"]
];

$result = $pdo->otherBinded($sql, $bindings);

if ($result === "error") {
    echo json_encode([
        "masterstatus" => "error",
        "msg" => "Could not add name"
    ]);
} else {
    echo json_encode([
        "masterstatus" => "success",
        "msg" => "Name added"
    ]);
}
?>
