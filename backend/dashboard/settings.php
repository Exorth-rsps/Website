<?php
require '../includes/auth.php';
require '../includes/db.php';
include '../templates/header.php';

check_logged_in(); // Accessible only for logged-in users

// Variables for error or success messages
$error = '';
$success = '';

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['display_name'])) {
        // Update display name
        $display_name = trim($_POST['display_name']);
        if (!empty($display_name)) {
            $stmt = $conn->prepare("UPDATE users SET display_name = ? WHERE id = ?");
            $stmt->bind_param("si", $display_name, $user_id);
            if ($stmt->execute()) {
                $success = "Display name successfully updated.";
            } else {
                $error = "Error updating your display name.";
            }
        } else {
            $error = "Display name cannot be empty.";
        }
    }

    if (isset($_POST['current_password'], $_POST['new_password'])) {
        // Change password
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];

        // Verify current password
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($current_password, $user['password'])) {
            // Update password
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $new_password_hash, $user_id);
            if ($stmt->execute()) {
                $success = "Password successfully updated.";
            } else {
                $error = "Error updating your password.";
            }
        } else {
            $error = "Current password is incorrect.";
        }
    }
}

// Retrieve the current display name
$stmt = $conn->prepare("SELECT display_name FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$current_display_name = $user['display_name'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Settings</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Settings</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <!-- Form to update display name -->
        <form method="post" class="mb-4">
            <h3>Update Display Name</h3>
            <div class="mb-3">
                <label for="display_name" class="form-label">Display Name</label>
                <input type="text" class="form-control" id="display_name" name="display_name" value="<?= htmlspecialchars($current_display_name) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <!-- Form to change password -->
        <form method="post">
            <h3>Change Password</h3>
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
