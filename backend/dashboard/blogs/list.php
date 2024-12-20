<?php
require '../../includes/auth.php';
require '../../includes/db.php';
include '../../templates/header.php';

check_logged_in(); // Accessible only for logged-in users

$current_role = $_SESSION['role'];

// Adjust query based on the user's role
if ($current_role === 'admin' || $current_role === 'author') {
    // Admins and authors can see all statuses
    $stmt = $conn->prepare("
        SELECT blogs.id, blogs.title, blogs.content, blogs.status, blogs.created_at, users.display_name AS author
        FROM blogs
        LEFT JOIN users ON blogs.author_id = users.id
        ORDER BY blogs.created_at DESC
    ");
} else {
    // Other roles can only see published blogs
    $stmt = $conn->prepare("
        SELECT blogs.id, blogs.title, blogs.content, blogs.status, blogs.created_at, users.display_name AS author
        FROM blogs
        LEFT JOIN users ON blogs.author_id = users.id
        WHERE blogs.status = 'published'
        ORDER BY blogs.created_at DESC
    ");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Blog List</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Blog List</h1>
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <p class="card-text">
                                <?= substr($row['content'], 0, 150) ?>...
                            </p>
                            <p class="text-muted">
                                Author: <?= htmlspecialchars($row['author'] ?? 'Unknown') ?><br>
                                Published on: <?= htmlspecialchars(date('F j, Y', strtotime($row['created_at']))) ?><br>
                                <span class="badge bg-secondary"><?= ucfirst($row['status']) ?></span>
                            </p>
                            <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-primary">Read More</a>
                            <?php if ($current_role === 'admin' || $current_role === 'author'): ?>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                            <?php endif; ?>
                        </div>

                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">No blogs available.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
