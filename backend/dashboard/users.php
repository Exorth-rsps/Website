<?php
require '../includes/auth.php';
require '../includes/db.php';
include '../templates/header.php';

check_role(['admin']); // Alleen toegankelijk voor admins

// Verwerken van POST-verzoeken
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id'], $_POST['role'])) {
        // Rol wijzigen
        $user_id = intval($_POST['user_id']);
        $role = $_POST['role'];

        $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $role, $user_id);

        if ($stmt->execute()) {
            $success = "Rol succesvol bijgewerkt.";
        } else {
            $error = "Fout bij het bijwerken van de rol.";
        }
    }

    if (isset($_POST['user_id'], $_POST['display_name'])) {
        // Schermnaam wijzigen
        $user_id = intval($_POST['user_id']);
        $display_name = trim($_POST['display_name']);

        $stmt = $conn->prepare("UPDATE users SET display_name = ? WHERE id = ?");
        $stmt->bind_param("si", $display_name, $user_id);

        if ($stmt->execute()) {
            $success = "Schermnaam succesvol bijgewerkt.";
        } else {
            $error = "Fout bij het bijwerken van de schermnaam.";
        }
    }
}

// Haal gebruikers op uit de database
$stmt = $conn->prepare("SELECT id, username, email, role, display_name, created_at FROM users");
$stmt->execute();
$result = $stmt->get_result();
?>

    <div class="container mt-5">
        <h1>Gebruikers Beheren</h1>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gebruikersnaam</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Schermnaam</th>
                    <th>Aangemaakt op</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td>
                            <!-- Formulier voor rol wijzigen -->
                            <form action="users.php" method="post" style="display: inline;">
                                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                <select name="role" class="form-select form-select-sm" style="width: auto; display: inline;">
                                    <option value="admin" <?= $row['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="author" <?= $row['role'] === 'author' ? 'selected' : '' ?>>Author</option>
                                    <option value="nothing" <?= $row['role'] === 'nothing' ? 'selected' : '' ?>>Nothing</option>
                                    <option value="banned" <?= $row['role'] === 'banned' ? 'selected' : '' ?>>Banned</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Wijzig Rol</button>
                            </form>
                        </td>
                        <td>
                            <!-- Formulier voor schermnaam wijzigen -->
                            <form action="users.php" method="post" style="display: inline;">
                                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                <input type="text" name="display_name" class="form-control form-control-sm" style="width: auto; display: inline;" value="<?= htmlspecialchars($row['display_name']) ?>" placeholder="Geen schermnaam">
                                <button type="submit" class="btn btn-sm btn-primary">Wijzig Schermnaam</button>
                            </form>
                        </td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                        <td>
                            <!-- Optioneel: Meer acties -->
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
