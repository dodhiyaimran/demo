<?php
session_start();
require 'config.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Add task
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $status = 'pending';
    $stmt = $pdo->prepare('INSERT INTO tasks (title, description, status, category_id, created_by, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
    $stmt->execute([$title, $description, $status, $category_id, $_SESSION['admin_id']]);
    header('Location: tasks.php');
    exit();
}

$tasks = $pdo->query('SELECT t.*, c.title AS category FROM tasks t LEFT JOIN categories c ON t.category_id = c.id ORDER BY t.updated_at DESC')->fetchAll();
$categories = $pdo->query('SELECT * FROM categories ORDER BY title')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
</head>
<body>
<h2>Tasks</h2>
<a href="dashboard.php">Back</a>
<table border="1">
<tr><th>Title</th><th>Status</th><th>Category</th><th>Actions</th></tr>
<?php foreach ($tasks as $task): ?>
<tr>
    <td><a href="view_task.php?id=<?= $task['id'] ?>"><?= htmlspecialchars($task['title']) ?></a></td>
    <td><?= htmlspecialchars($task['status']) ?></td>
    <td><?= htmlspecialchars($task['category']) ?></td>
    <td></td>
</tr>
<?php endforeach; ?>
</table>
<form method="post">
    <h3>Add Task</h3>
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="description" placeholder="Description"></textarea>
    <select name="category_id">
        <?php foreach ($categories as $c): ?>
        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['title']) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Save</button>
</form>
</body>
</html>
