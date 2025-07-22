<?php
require_once __DIR__.'/inc/Task.php';
require_once __DIR__.'/inc/User.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$taskModel = new Task();
$tasks = $taskModel->userTasks($_SESSION['user_id']);
include __DIR__.'/inc/header.php';
?>
<h3>My Tasks</h3>
<ul class="list-group">
<?php foreach($tasks as $t): ?>
<li class="list-group-item"><a href="task_detail.php?id=<?= $t['id'] ?>"><?= htmlspecialchars($t['title']) ?></a> <span class="badge bg-secondary"><?= htmlspecialchars($t['status']) ?></span></li>
<?php endforeach; ?>
</ul>
<?php include __DIR__.'/inc/footer.php'; ?>
