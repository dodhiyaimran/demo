<?php
require_once __DIR__.'/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByMobile($mobile) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE mobile = ? LIMIT 1');
        $stmt->execute([$mobile]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($name, $mobile, $company, $isAdmin = 0) {
        $stmt = $this->db->prepare('INSERT INTO users (name, mobile, company, is_admin_login, status, created_at) VALUES (?,?,?,?,1,NOW())');
        $stmt->execute([$name, $mobile, $company, $isAdmin]);
        return $this->db->lastInsertId();
    }

    public function all() {
        $stmt = $this->db->query('SELECT * FROM users ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function update($id, $name, $mobile, $company, $isAdmin, $status) {
        $stmt = $this->db->prepare('UPDATE users SET name=?, mobile=?, company=?, is_admin_login=?, status=? WHERE id=?');
        return $stmt->execute([$name, $mobile, $company, $isAdmin, $status, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id=?');
        return $stmt->execute([$id]);
    }

    public function toggleStatus($id) {
        $user = $this->findById($id);
        $newStatus = $user['status'] ? 0 : 1;
        $stmt = $this->db->prepare('UPDATE users SET status=? WHERE id=?');
        return $stmt->execute([$newStatus, $id]);
    }
}
?>
