<?php
// Headers instellen voor CORS en JSON-respons
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Controleer of de request methode POST is
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Ongeldige request-methode"]);
    exit;
}

// JSON input ophalen en decoderen
$data = json_decode(file_get_contents("php://input"), true);

// Controleer of 'email' aanwezig en niet leeg is
if (empty($data["email"])) {
    http_response_code(400);
    echo json_encode(["error" => "Geen e-mailtekst ontvangen"]);
    exit;
}

$email = trim($data["email"]);

// Simuleer een phishing-analyse (later vervangen door AI-model)
$isPhishing = rand(0, 1) ? "Ja" : "Nee";

// JSON-respons terugsturen
http_response_code(200);
echo json_encode([
    "message" => "E-mail geanalyseerd",
    "content" => $email,
    "is_phishing" => $isPhishing
]);
?>