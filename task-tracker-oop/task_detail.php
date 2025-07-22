<?php
require_once __DIR__.'/inc/Task.php';
require_once __DIR__.'/inc/Comment.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: mobile_login.php');
    exit();
}
$taskModel = new Task();
$commentModel = new Comment();
$task = $taskModel->find($_GET['id']);
if (!$task) die('Task not found');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentModel->add($task['id'],$_POST['comment'],$_SESSION['user_id']);
    header('Location: task_detail.php?id='.$task['id']);
    exit();
}
$comments = $commentModel->forTask($task['id']);
include __DIR__.'/inc/header.php';
?>
<h3><?= htmlspecialchars($task['title']) ?></h3>
<p>Status: <?= htmlspecialchars($task['status']) ?></p>
<p>Category: <?= htmlspecialchars($task['category']) ?></p>
<p><?= nl2br(htmlspecialchars($task['description'])) ?></p>
<ul class="list-group mt-3">
<?php foreach($comments as $c): ?>
<li class="list-group-item"><strong><?= htmlspecialchars($c['name']) ?></strong> (<?= $c['created_at'] ?>)<br><?= htmlspecialchars($c['comment']) ?></li>
<?php endforeach; ?>
</ul>
<form method="post" class="mt-3">
 <textarea name="comment" class="form-control" placeholder="Add comment"></textarea>
 <button class="btn btn-primary mt-2">Post</button>
</form>
<?php include __DIR__.'/inc/footer.php'; ?>
