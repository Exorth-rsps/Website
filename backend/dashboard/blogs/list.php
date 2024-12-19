<?php
require '../includes/auth.php';
check_role(['admin', 'author']);

require '../includes/db.php';

$stmt = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");

while ($blog = $stmt->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . htmlspecialchars($blog['title']) . "</h3>";
    echo "<p>Status: " . $blog['status'] . "</p>";
    echo "<a href='edit.php?id=" . $blog['id'] . "'>Bewerken</a>";
    echo "</div><hr>";
}
?>
