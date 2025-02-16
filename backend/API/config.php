<?php
// 📌 Databaseconfiguratie (pas dit aan met je eigen databasegegevens)
define("DB_HOST", "localhost");    // Database server (meestal 'localhost')
define("DB_USER", "root");         // Database gebruikersnaam
define("DB_PASS", "");             // Database wachtwoord (laat leeg als er geen wachtwoord is)
define("DB_NAME", "phishing_db");  // Database naam

// 📌 Verbinding maken met de database (optioneel, als je een database gebruikt)
function connectDatabase() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Controleer of de verbinding is gelukt
    if ($conn->connect_error) {
        die("Verbindingsfout: " . $conn->connect_error);
    }

    return $conn;
}

// 📌 Algemene instellingen
define("API_VERSION", "1.0");  // Versie van de API

?>
