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









?>