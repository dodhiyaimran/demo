<?php
session_start();
require 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: mobile_login.html');
    exit();
}

$user_id = $_SESSION['user_id'];
$tasks = $pdo->prepare('SELECT t.*, c.title AS category FROM tasks t LEFT JOIN categories c ON t.category_id = c.id WHERE t.created_by = ? ORDER BY t.updated_at DESC');
$tasks->execute([$user_id]);
$tasks = $tasks->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>
</head>
<body>
<h2>My Tasks</h2>
<ul>
<?php foreach ($tasks as $task): ?>
    <li><a href="task_detail.php?id=<?= $task['id'] ?>"><?= htmlspecialchars($task['title']) ?></a> (<?= htmlspecialchars($task['status']) ?>)</li>
<?php endforeach; ?>
</ul>
</body>
</html>
