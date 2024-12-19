<?php
require '../includes/auth.php';
check_role(['admin']);

$stmt = $conn->query("SELECT id, username, role FROM users");
while ($user = $stmt->fetch_assoc()) {
    echo "<div>{$user['username']} ({$user['role']})";
    echo "<form action='change_role.php' method='post'>
        <input type='hidden' name='user_id' value='{$user['id']}'>
        <select name='role'>
            <option value='admin'>Admin</option>
            <option value='author'>Author</option>
            <option value='nothing'>Nothing</option>
            <option value='banned'>Banned</option>
        </select>
        <button type='submit'>Wijzig Rol</button>
    </form></div>";
}
?>
