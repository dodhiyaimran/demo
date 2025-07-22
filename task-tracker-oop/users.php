<?php
require_once __DIR__.'/inc/User.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$userModel = new User();
$editUser = null;

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

if (isset($_GET['edit'])) {
    $editUser = $userModel->findById($_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id      = $_POST['id'] ?? '';
    $name    = $_POST['name'];
    $mobile  = $_POST['mobile'];
    $company = $_POST['company'];
    $isAdmin = $_POST['is_admin'];
    $status  = isset($_POST['status']) ? 1 : 0;
    if ($id) {
        $userModel->update($id,$name,$mobile,$company,$isAdmin,$status);
    } else {
        $userModel->create($name,$mobile,$company,$isAdmin);
    }
    header('Location: users.php');
    exit();
}

$users = $userModel->all();
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
 <td><a href="users.php?edit=<?= $u['id'] ?>">Edit</a> | <a href="users.php?delete=<?= $u['id'] ?>" onclick="return confirm('Delete user?');">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>

<h4><?= $editUser ? 'Edit User' : 'Add User' ?></h4>
<form method="post" class="mt-3">
 <input type="hidden" name="id" value="<?= $editUser['id'] ?? '' ?>">
 <div class="mb-3">
  <label class="form-label">Name</label>
  <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($editUser['name'] ?? '') ?>" required>
 </div>
 <div class="mb-3">
  <label class="form-label">Mobile</label>
  <input type="text" name="mobile" class="form-control" value="<?= htmlspecialchars($editUser['mobile'] ?? '') ?>" required>
 </div>
 <div class="mb-3">
  <label class="form-label">Company</label>
  <input type="text" name="company" class="form-control" value="<?= htmlspecialchars($editUser['company'] ?? '') ?>">
 </div>
 <div class="mb-3">
  <label class="form-label">Role</label>
  <select name="is_admin" class="form-select">
   <option value="0" <?= isset($editUser) && !$editUser['is_admin_login'] ? 'selected' : '' ?>>User</option>
   <option value="1" <?= isset($editUser) && $editUser['is_admin_login'] ? 'selected' : '' ?>>Admin</option>
  </select>
 </div>
 <div class="form-check mb-3">
  <input class="form-check-input" type="checkbox" id="statusCheck" name="status" value="1" <?= !isset($editUser) || ($editUser && $editUser['status']) ? 'checked' : '' ?>>
  <label class="form-check-label" for="statusCheck">Active</label>
 </div>
 <button class="btn btn-primary"><?= $editUser ? 'Update' : 'Add' ?></button>
</form>
<?php include __DIR__.'/inc/footer.php'; ?>
