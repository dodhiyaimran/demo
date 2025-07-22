<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
<h2>Dashboard</h2>
<nav>
    <a href="users.php">Users</a> |
    <a href="categories.php">Categories</a> |
    <a href="tasks.php">Tasks</a> |
    <a href="logout.php">Logout</a>
</nav>
</body>
</html>
