<?php
require '../../includes/auth.php';
require '../../includes/db.php';
include '../../templates/header.php';

check_logged_in(); // Accessible only for logged-in users

$current_role = $_SESSION['role'];

// Get the blog ID from the URL
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Adjust query based on the user's role
if ($current_role === 'admin' || $current_role === 'author') {
    // Admins and authors can view all blogs
    $stmt = $conn->prepare("
        SELECT blogs.title, blogs.content, blogs.status, blogs.created_at, users.display_name AS author
        FROM blogs
        LEFT JOIN users ON blogs.author_id = users.id
        WHERE blogs.id = ?
    ");
} else {
    // Other roles can only view published blogs
    $stmt = $conn->prepare("
        SELECT blogs.title, blogs.content, blogs.status, blogs.created_at, users.display_name AS author
        FROM blogs
        LEFT JOIN users ON blogs.author_id = users.id
        WHERE blogs.id = ? AND blogs.status = 'published'
    ");
}

$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Blog not found or not accessible
    header("HTTP/1.0 404 Not Found");
    echo "<div class='container mt-5'><h1>Blog Not Found</h1><p>The blog you are looking for does not exist or is not accessible.</p></div>";
    exit;
}

$blog = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?= htmlspecialchars($blog['title']) ?></title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-3"><?= htmlspecialchars($blog['title']) ?></h1>
        <p class="text-muted">
            Author: <?= htmlspecialchars($blog['author'] ?? 'Unknown') ?><br>
            Published on: <?= htmlspecialchars(date('F j, Y', strtotime($blog['created_at']))) ?><br>
            <span class="badge bg-secondary"><?= ucfirst($blog['status']) ?></span>
        </p>
        <hr>
        <div class="content">
            <?= $blog['content'] ?> <!-- Render HTML directly -->
        </div>
        <?php if ($current_role === 'admin' || $current_role === 'author'): ?>
            <a href="edit.php?id=<?= $blog_id ?>" class="btn btn-warning mt-4">Edit</a>
        <?php endif; ?>
        <a href="list.php" class="btn btn-secondary mt-4">Back to Blog List</a>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
