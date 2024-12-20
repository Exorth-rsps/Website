<?php
require '../includes/auth.php';
check_logged_in();

// Menu-opties per rol
$menu_items = [
    'admin' => [
        ['label' => 'Gebruikers Beheren', 'url' => 'users.php'],
    ],
    'author' => [
        ['label' => 'Nieuwe Blog Aanmaken', 'url' => 'blogs/create.php'],
    ],
    'nothing' => [
        ['label' => 'Blogs', 'url' => 'blogs/list.php'],
        ['label' => 'Instellingen', 'url' => 'settings.php'],
    ],
    'banned' => [
        ['label' => 'Your banned form this!', 'url' => '#'],
    ],
];

// Huidige rol ophalen
$current_role = $_SESSION['role'];

// Rollen die de huidige gebruiker mag zien
$visible_roles = [];

// Stel de zichtbare rollen in op basis van de huidige rol
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
        <h1 class="mb-4">Welkom op het Dashboard</h1>
        <div class="row">
            <?php foreach ($visible_roles as $role): ?>
                <?php if (isset($menu_items[$role])): ?>
                    <?php foreach ($menu_items[$role] as $item): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($item['label']) ?></h5>
                                    <a href="<?= htmlspecialchars($item['url']) ?>" class="btn btn-primary">Openen</a>
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
