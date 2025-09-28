<?php
$host = 'localhost';       // Database host
$db = 'u43361p163932_exorthblog'; // Database naam
$user = 'u43361p163932_exorthblog'; // Database gebruiker
$pass = 'awivgjeizsdrhnL56898!'; // Database wachtwoord

$conn = new mysqli($host, $user, $pass, $db);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Fout bij verbinden met database: " . $conn->connect_error);
}

// Stel de charset in
$conn->set_charset("utf8mb4");
?>
