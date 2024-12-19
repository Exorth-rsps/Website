<?php
require '../includes/auth.php';
check_role(['admin', 'author']);

require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE blogs SET title = ?, content = ?, status = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $content, $status, $id);

    if ($stmt->execute()) {
        echo "Blog bijgewerkt!";
    } else {
        echo "Fout bij bijwerken: " . $conn->error;
    }
    exit;
}

// Haal de huidige blog op
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();
?>

<form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?= $blog['id'] ?>">
    <input type="text" name="title" value="<?= htmlspecialchars($blog['title']) ?>" required>
    <textarea id="content" name="content"><?= htmlspecialchars($blog['content']) ?></textarea>
    <select name="status">
        <option value="draft" <?= $blog['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
        <option value="published" <?= $blog['status'] == 'published' ? 'selected' : '' ?>>Published</option>
        <option value="archived" <?= $blog['status'] == 'archived' ? 'selected' : '' ?>>Archived</option>
    </select>
    <button type="submit">Opslaan</button>
</form>
