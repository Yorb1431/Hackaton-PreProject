<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // JSON input ophalen en decoderen
        $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["email"]) || empty(trim($data["email"]))) {
            echo json_encode(["error" => "Geen e-mailtekst ontvangen"]);
            http_response_code(400);
            exit;
    }
    
    $email = trim($data["email"]);
    $isPhishing = rand(0, 1) ? "Ja" : "Nee"; // Willekeurige testwaarde

    echo json_encode([
        "message" => "E-mail geanalyseerd",
        "content" => $email,
        "is_phishing" => $isPhishing
    ]);
} else {
    echo json_encode(["error" => "Ongeldige request-methode"]);
    http_response_code(405);
}









?>