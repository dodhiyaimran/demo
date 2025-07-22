<?php
session_start();
require 'config.php';
$mobile = $_POST['mobile'] ?? '';
$otp = $_POST['otp'] ?? '';

$stmt = $pdo->prepare('SELECT * FROM otp_verification WHERE mobile = ? ORDER BY created_at DESC LIMIT 1');
$stmt->execute([$mobile]);
$record = $stmt->fetch();

if ($record && $record['otp'] == $otp && strtotime($record['created_at']) > time() - 600) {
    // OTP valid for 10 minutes
    // Find or create user
    $stmt = $pdo->prepare('SELECT id FROM users WHERE mobile = ?');
    $stmt->execute([$mobile]);
    $user = $stmt->fetch();
    if (!$user) {
        $pdo->prepare('INSERT INTO users (name, mobile, status) VALUES (?, ?, 1)')->execute([$mobile, $mobile]);
        $user_id = $pdo->lastInsertId();
    } else {
        $user_id = $user['id'];
    }
    $_SESSION['user_id'] = $user_id;
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'failed']);
}
?>
