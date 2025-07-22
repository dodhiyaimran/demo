<?php
require_once __DIR__.'/inc/User.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$userModel = new User();
$id = $_GET['id'] ?? '';
$editUser = null;
if ($id) {
    $editUser = $userModel->findById($id);
    if (!$editUser) {
        header('Location: users.php');
        exit();
    }
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

include __DIR__.'/inc/header.php';
?>
<h3><?= $editUser ? 'Edit User' : 'Add User' ?></h3>
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
 <a href="users.php" class="btn btn-secondary ms-2">Back</a>
</form>
<?php include __DIR__.'/inc/footer.php'; ?>
