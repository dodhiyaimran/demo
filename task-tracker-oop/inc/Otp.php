<?php
require_once __DIR__.'/Database.php';

class Otp {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function send($mobile,$otp) {
        // Placeholder for MSG91 OTP API integration
        // Example: call MSG91 API to send the OTP
        return true;
    }
    public function create($mobile,$otp) {
        $stmt = $this->db->prepare('INSERT INTO otp_verification (mobile, otp, created_at) VALUES (?,?,NOW())');
        $stmt->execute([$mobile,$otp]);
    }
    public function verify($mobile,$otp) {
        $stmt = $this->db->prepare('SELECT id FROM otp_verification WHERE mobile=? AND otp=? AND created_at >= (NOW() - INTERVAL 10 MINUTE) ORDER BY id DESC LIMIT 1');
        $stmt->execute([$mobile,$otp]);
        $row = $stmt->fetch();
        if ($row) {
            $this->db->prepare('DELETE FROM otp_verification WHERE id=?')->execute([$row['id']]);
            return true;
        }
        return false;
    }
}
?>
