<?php
$host = 'localhost';       // Database host
$db = 'jouw_database_naam'; // Database naam
$user = 'jouw_database_gebruiker'; // Database gebruiker
$pass = 'jouw_database_wachtwoord'; // Database wachtwoord

$conn = new mysqli($host, $user, $pass, $db);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Fout bij verbinden met database: " . $conn->connect_error);
}

// Stel de charset in
$conn->set_charset("utf8mb4");
?>
