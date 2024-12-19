<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?");
    $stmt->bind_param("ss", $new_password, $token);

    if ($stmt->execute()) {
        echo "Wachtwoord succesvol aangepast!";
    } else {
        echo "Fout bij aanpassen: " . $conn->error;
    }
    exit;
}

$token = $_GET['token'] ?? '';
?>

<form action="reset_password.php" method="post">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    <input type="password" name="password" placeholder="Nieuw wachtwoord" required>
    <button type="submit">Reset Wachtwoord</button>
</form>
