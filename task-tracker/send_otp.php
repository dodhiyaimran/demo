<?php
require 'config.php';
$mobile = $_POST['mobile'] ?? '';
$otp = rand(100000, 999999);

// Insert OTP record
$stmt = $pdo->prepare('INSERT INTO otp_verification (mobile, otp, created_at) VALUES (?, ?, NOW())');
$stmt->execute([$mobile, $otp]);

// Send OTP via MSG91 API (placeholder)
$apiKey = 'YOUR_MSG91_KEY';
$message = urlencode("Your OTP is $otp");
$url = "https://api.msg91.com/api/v5/otp?template_id=YOUR_TEMPLATE&mobile=$mobile&authkey=$apiKey&otp=$otp";
file_get_contents($url);

echo json_encode(['status' => 'success']);
?>
