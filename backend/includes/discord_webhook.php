<?php
/**
 * Discord Webhook Configuratie
 * Plaats hier de URL van je webhook.
 */
define('DISCORD_WEBHOOK_URL', 'https://discord.com/api/webhooks/1319760826839859200/8mP4HM4sYH9NhVL9Z9iYZy81FamP4Cc1JKr2qa_PjpMkHVm-eqh_fQqYnVq91J7pI8lS');

/**
 * Verstuurt een bericht naar een Discord-webhook.
 *
 * @param string $title De titel van het blogbericht.
 * @param string $url De link naar het blogbericht.
 * @return string|null De response van Discord of null bij een fout.
 */
function sendToDiscord($title, $url) {
    $webhook_url = DISCORD_WEBHOOK_URL;

    // Berichtinhoud
    $message = [
        "content" => "**New News has Arrived**\n$title\nCheck it out here: $url",
        "username" => "Exorth.net", // Naam van de bot die het bericht verstuurt
    ];

    // cURL-initialisatie
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
    ]);

    // Voer de cURL-aanroep uit
    $response = curl_exec($ch);

    // Foutafhandeling
    if (curl_errno($ch)) {
        error_log('Discord webhook error: ' . curl_error($ch));
        $response = null;
    }

    curl_close($ch);

    return $response;
}
