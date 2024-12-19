<?php
require '../includes/auth.php';
check_role(['admin', 'author', 'nothing']);

echo "Welkom op het dashboard!";
if ($_SESSION['role'] == 'admin') {
    echo "<a href='users.php'>Gebruikers beheren</a>";
}
if ($_SESSION['role'] == 'author') {
    echo "<a href='blogs/list.php'>Blogs beheren</a>";
}
?>
