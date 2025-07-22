<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id, password FROM users WHERE username = ? AND is_admin_login = 1 LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
<h2>Admin Login</h2>
<?php if (!empty($error)): ?>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
</body>
</html>
