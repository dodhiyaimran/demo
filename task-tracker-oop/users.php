<?php
require_once __DIR__.'/inc/User.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$userModel = new User();

if (isset($_GET['delete'])) {
    $userModel->delete($_GET['delete']);
    header('Location: users.php');
    exit();
}

if (isset($_GET['toggle'])) {
    $userModel->toggleStatus($_GET['toggle']);
    header('Location: users.php');
    exit();
}

$perPage = 10;
$page    = isset($_GET["page"]) ? max(1,(int)$_GET["page"]) : 1;
$total   = $userModel->countAll();
$users   = $userModel->paginate($page, $perPage);
$totalPages = (int)ceil($total / $perPage);

include __DIR__.'/inc/header.php';
?>
<h3>Users</h3>
<table class="table table-bordered">
<tr><th>Name</th><th>Mobile</th><th>Company</th><th>Role</th><th>Status</th><th>Actions</th></tr>
<?php foreach($users as $u): ?>
<tr>
 <td><?= htmlspecialchars($u['name']) ?></td>
 <td><?= htmlspecialchars($u['mobile']) ?></td>
 <td><?= htmlspecialchars($u['company']) ?></td>
 <td><?= $u['is_admin_login'] ? 'Admin' : 'User' ?></td>
 <td><?= $u['status'] ? 'Active' : 'Inactive' ?> (<a href="users.php?toggle=<?= $u['id'] ?>">toggle</a>)</td>
 <td><a href="user_form.php?id=<?= $u['id'] ?>">Edit</a> | <a href="users.php?delete=<?= $u['id'] ?>" onclick="return confirm('Delete user?');">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
<div class="mb-3">
 <a href="user_form.php" class="btn btn-success">Add User</a>
</div>
<?php if ($totalPages > 1): ?>
<nav>
 <ul class="pagination">
  <?php for ($i = 1; $i <= $totalPages; $i++): ?>
   <li class="page-item <?= $i == $page ? 'active' : '' ?>">
    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
   </li>
  <?php endfor; ?>
 </ul>
</nav>
<?php endif; ?>

<?php include __DIR__.'/inc/footer.php'; ?>
