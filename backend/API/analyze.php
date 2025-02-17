<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Alleen POST requests accepteren
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Ongeldige request-methode"]);
    exit;
}

// JSON input ophalen en decoderen
$data = json_decode(file_get_contents("php://input"), true);

// Controleren of er een e-mailtekst is ontvangen
if (empty($data["email"])) {
    http_response_code(400);
    echo json_encode(["error" => "Geen e-mailtekst ontvangen"]);
    exit;
}

$email = trim($data["email"]);

// URLs extraheren uit de e-mailtekst
preg_match_all('/https?:\/\/[^\s"]+/', $email, $matches);
$urls = $matches[0];

if (empty($urls)) {
    http_response_code(400);
    echo json_encode(["error" => "Geen URL's gevonden in de e-mail"]);
    exit;
}

// Voor nu random bepalen of de URL phishing is (later vervangen door AI)
$isPhishing = rand(0, 1) ? "Ja" : "Nee";

http_response_code(200);
echo json_encode([
    "message" => "URL geanalyseerd",
    "urls" => $urls,
    "is_phishing" => $isPhishing
]);
?>
