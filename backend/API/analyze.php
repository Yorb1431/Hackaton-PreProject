<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Ongeldige request-methode"]);
    exit;
}


$data = json_decode(file_get_contents("php://input"), true);


if (empty($data["email"])) {
    http_response_code(400);
    echo json_encode(["error" => "Geen e-mailtekst ontvangen"]);
    exit;
}

$email = trim($data["email"]);


$isPhishing = rand(0, 1) ? "Ja" : "Nee";


?>