<?php
require_once __DIR__.'/inc/User.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
include __DIR__.'/inc/header.php';
?>
<h2>Dashboard</h2>
<p>Welcome to the admin dashboard.</p>
<?php include __DIR__.'/inc/footer.php'; ?>
