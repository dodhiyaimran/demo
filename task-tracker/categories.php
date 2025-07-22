<?php
session_start();
require 'config.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Add category
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $stmt = $pdo->prepare('INSERT INTO categories (title, description) VALUES (?, ?)');
    $stmt->execute([$title, $description]);
    header('Location: categories.php');
    exit();
}

$categories = $pdo->query('SELECT * FROM categories ORDER BY id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
<h2>Categories</h2>
<a href="dashboard.php">Back</a>
<ul>
<?php foreach ($categories as $cat): ?>
    <li><?= htmlspecialchars($cat['title']) ?></li>
<?php endforeach; ?>
</ul>
<form method="post">
    <h3>Add Category</h3>
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Save</button>
</form>
</body>
</html>
