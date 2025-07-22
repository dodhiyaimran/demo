<?php
session_start();
require 'config.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Add user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $status = isset($_POST['status']) ? 1 : 0;
    $company = $_POST['company'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare('INSERT INTO users (name, mobile, status, company, password, created_by) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$name, $mobile, $status, $company, $password, $_SESSION['admin_id']]);
    header('Location: users.php');
    exit();
}

$users = $pdo->query('SELECT * FROM users ORDER BY id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
<h2>Users</h2>
<a href="dashboard.php">Back</a>
<table border="1">
<tr><th>Name</th><th>Mobile</th><th>Status</th></tr>
<?php foreach ($users as $user): ?>
<tr>
    <td><?= htmlspecialchars($user['name']) ?></td>
    <td><?= htmlspecialchars($user['mobile']) ?></td>
    <td><?= $user['status'] ? 'Active' : 'Inactive' ?></td>
</tr>
<?php endforeach; ?>
</table>
<form method="post">
    <h3>Add User</h3>
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="mobile" placeholder="Mobile" required>
    <input type="text" name="company" placeholder="Company">
    <input type="password" name="password" placeholder="Password" required>
    <label><input type="checkbox" name="status" value="1"> Active</label>
    <button type="submit">Save</button>
</form>
</body>
</html>
