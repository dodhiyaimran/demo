<?php
session_start();
require 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: mobile_login.html');
    exit();
}

$task_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare('SELECT t.*, c.title AS category FROM tasks t LEFT JOIN categories c ON t.category_id = c.id WHERE t.id = ?');
$stmt->execute([$task_id]);
$task = $stmt->fetch();
if (!$task) {
    echo 'Task not found';
    exit();
}

// Add comment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'];
    $stmt = $pdo->prepare('INSERT INTO task_comments (task_id, comment, created_by, created_at) VALUES (?, ?, ?, NOW())');
    $stmt->execute([$task_id, $comment, $_SESSION['user_id']]);
    header('Location: task_detail.php?id=' . $task_id);
    exit();
}

$comments = $pdo->prepare('SELECT c.comment, c.created_at, u.name FROM task_comments c LEFT JOIN users u ON c.created_by = u.id WHERE c.task_id = ? ORDER BY c.created_at DESC');
$comments->execute([$task_id]);
$comments = $comments->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Detail</title>
</head>
<body>
<a href="tasks_list.php">Back</a>
<h2><?= htmlspecialchars($task['title']) ?></h2>
<p>Status: <?= htmlspecialchars($task['status']) ?></p>
<p><?= nl2br(htmlspecialchars($task['description'])) ?></p>
<ul>
<?php foreach ($comments as $c): ?>
    <li><strong><?= htmlspecialchars($c['name']) ?></strong> (<?= $c['created_at'] ?>): <?= htmlspecialchars($c['comment']) ?></li>
<?php endforeach; ?>
</ul>
<form method="post">
    <textarea name="comment" placeholder="Add comment" required></textarea>
    <button type="submit">Send</button>
</form>
</body>
</html>
