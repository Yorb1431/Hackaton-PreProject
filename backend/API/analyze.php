<?php
// 📌 CORS en headers instellen zodat andere systemen toegang hebben tot deze API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// 📌 Controleer of het verzoek een POST-methode is
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405); // 405 = Method Not Allowed
    echo json_encode(["error" => "Ongeldige request-methode"]);
    exit;
}

// 📌 JSON input ophalen en decoderen
$data = json_decode(file_get_contents("php://input"), true);

// 📌 Controleer of er een 'email' veld in de input zit en of deze niet leeg is
if (empty($data["email"])) {
    http_response_code(400); // 400 = Bad Request
    echo json_encode(["error" => "Geen e-mailtekst ontvangen"]);
    exit;
}

// 📌 De ontvangen e-mailtekst opschonen
$email = trim($data["email"]);

// 📌 Simuleer een phishing-detectie (voor nu random "Ja" of "Nee")
// 🚀 TODO: Hier moet later een verzoek naar het AI-model komen om echte detectie uit te voeren
$isPhishing = rand(0, 1) ? "Ja" : "Nee";

// 📌 JSON-respons terugsturen met de analyse
http_response_code(200); // 200 = OK
echo json_encode([
    "message" => "E-mail geanalyseerd",
    "content" => $email,
    "is_phishing" => $isPhishing
]);
?>
