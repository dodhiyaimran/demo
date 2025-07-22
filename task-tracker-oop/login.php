<?php
require_once __DIR__.'/inc/User.php';
require_once __DIR__.'/inc/Otp.php';

$userModel = new User();
$otpModel  = new Otp();
$err  = '';
$step = 1;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mobile']) && !isset($_POST['otp'])) {
        $mobile = $_POST['mobile'];
        $otp = rand(100000,999999);
        $otpModel->create($mobile,$otp);
        $otpModel->send($mobile,$otp);
        $step = 2;
    } elseif (isset($_POST['otp'])) {
        $mobile = $_POST['mobile_hidden'];
        if ($otpModel->verify($mobile,$_POST['otp'])) {
            $user = $userModel->findByMobile($mobile);
            if (!$user) {
                $userId = $userModel->create($mobile,$mobile,'');
                $user   = $userModel->findById($userId);
            }
            $_SESSION['user_id'] = $user['id'];
            if ($user['is_admin_login']) {
                $_SESSION['admin_id'] = $user['id'];
                header('Location: dashboard.php');
            } else {
                header('Location: tasks_list.php');
            }
            exit();
        } else {
            $err  = 'Invalid OTP';
            $step = 2;
        }
    }
}
include __DIR__.'/inc/header.php';
?>
<div class="row justify-content-center">
 <div class="col-md-4">
  <h3 class="mb-3">Login</h3>
  <?php if ($err): ?><div class="alert alert-danger"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <?php if ($step == 1): ?>
  <form method="post">
   <div class="mb-3">
    <label class="form-label">Mobile</label>
    <input type="text" name="mobile" class="form-control" required>
   </div>
   <button class="btn btn-primary">Send OTP</button>
  </form>
  <?php else: ?>
  <form method="post">
   <input type="hidden" name="mobile_hidden" value="<?= htmlspecialchars($mobile) ?>">
   <div class="mb-3">
    <label class="form-label">Enter OTP</label>
    <input type="text" name="otp" class="form-control" required>
   </div>
   <button class="btn btn-primary">Verify</button>
  </form>
  <?php endif; ?>
 </div>
</div>
<?php include __DIR__.'/inc/footer.php'; ?>
