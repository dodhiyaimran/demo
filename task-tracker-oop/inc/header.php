<?php
session_start();
$isAdmin = isset($_SESSION['admin_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Task Tracker</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= $isAdmin ? 'dashboard.php' : 'tasks_list.php' ?>">Task Tracker</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if ($isAdmin): ?>
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="tasks.php">Tasks</a></li>
          <li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
          <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
        <?php elseif (isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="tasks_list.php">My Tasks</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
