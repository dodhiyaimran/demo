<?php
require_once __DIR__.'/inc/User.php';

$userModel = new User();
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobile = $_POST['mobile'];
    $user = $userModel->findByMobile($mobile);
    if ($user && $user['is_admin_login']) {
        $_SESSION['admin_id'] = $user['id'];
        header('Location: dashboard.php');
        exit();
    } else {
        $err = 'Invalid admin mobile';
    }
}
include __DIR__.'/inc/header.php';
?>
<div class="row justify-content-center">
 <div class="col-md-4">
  <h3 class="mb-3">Admin Login</h3>
  <?php if ($err): ?><div class="alert alert-danger"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <form method="post">
   <div class="mb-3">
    <label class="form-label">Mobile</label>
    <input type="text" name="mobile" class="form-control" required>
   </div>
   <button class="btn btn-primary">Login</button>
  </form>
 </div>
</div>
<?php include __DIR__.'/inc/footer.php'; ?>
