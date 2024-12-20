<?php
require '../includes/auth.php';
check_logged_in();

// Menu options by role
$menu_items = [
    'admin' => [
        ['label' => 'Manage Users', 'url' => 'users.php'],
    ],
    'author' => [
        ['label' => 'Create New Blog', 'url' => 'blogs/create.php'],
    ],
    'nothing' => [
        ['label' => 'Blogs', 'url' => 'blogs/list.php'],
        ['label' => 'Settings', 'url' => 'settings.php'],
    ],
    'banned' => [
        ['label' => 'You are banned from this!', 'url' => '#'],
    ],
];

// Get current role
$current_role = $_SESSION['role'];

// Roles the current user is allowed to see
$visible_roles = [];

// Set visible roles based on the current role
switch ($current_role) {
    case 'admin':
        $visible_roles = ['admin', 'author', 'nothing'];
        break;
    case 'author':
        $visible_roles = ['author', 'nothing'];
        break;
    case 'nothing':
        $visible_roles = ['nothing'];
        break;
    case 'banned':
        $visible_roles = ['banned'];
        break;
}
include '../templates/header.php';
?>

<div class="container mt-4">
    <h1 class="mb-4">Welcome to the Blog Dashboard</h1>
    <div class="row">
        <?php foreach ($visible_roles as $role): ?>
            <?php if (isset($menu_items[$role])): ?>
                <?php foreach ($menu_items[$role] as $item): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['label']) ?></h5>
                                <a href="<?= htmlspecialchars($item['url']) ?>" class="btn btn-primary">Open</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
