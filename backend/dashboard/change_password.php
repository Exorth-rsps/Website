<?php
require '../includes/auth.php';
require '../includes/db.php';

check_role(['admin', 'author', 'nothing']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (password_verify($current_password, $user['password'])) {
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $new_password, $user_id);
        $stmt->execute();

        echo "Wachtwoord succesvol aangepast!";
    } else {
        echo "Huidig wachtwoord is onjuist.";
    }
}
?>

<form action="change_password.php" method="post">
    <input type="password" name="current_password" placeholder="Huidig wachtwoord" required>
    <input type="password" name="new_password" placeholder="Nieuw wachtwoord" required>
    <button type="submit">Wachtwoord Wijzigen</button>
</form>
