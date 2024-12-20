<?php
session_start(); // Start de sessie

/**
 * Controleert of een gebruiker is ingelogd.
 * Als de gebruiker niet is ingelogd, wordt hij doorgestuurd naar de loginpagina.
 */
function check_logged_in() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login.php");
        exit;
    }
}

/**
 * Controleert of de ingelogde gebruiker een van de vereiste rollen heeft.
 * Als dat niet zo is, wordt de toegang geweigerd.
 */
function check_role($roles) {
    check_logged_in(); // Controleer of de gebruiker is ingelogd

    if (!in_array($_SESSION['role'], $roles)) {
        die("Toegang geweigerd: onvoldoende rechten.");
    }
}

/**
 * Logt een gebruiker in door zijn gegevens op te slaan in de sessie.
 *
 * @param int $user_id Het ID van de gebruiker.
 * @param string $role De rol van de gebruiker.
 */
function login($user_id, $role) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['role'] = $role;
}

/**
 * Logt de gebruiker uit en vernietigt de sessie.
 */
function logout() {
    session_destroy();
    header("Location: /login.php");
    exit;
}
?>
