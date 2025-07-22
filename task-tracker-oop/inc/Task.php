<?php
require_once __DIR__.'/Database.php';

class Task {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function all() {
        $stmt = $this->db->query('SELECT t.*, c.title AS category FROM tasks t LEFT JOIN categories c ON t.category_id = c.id ORDER BY t.updated_at DESC');
        return $stmt->fetchAll();
    }
    public function userTasks($userId) {
        $stmt = $this->db->prepare('SELECT t.*, c.title AS category FROM tasks t LEFT JOIN categories c ON t.category_id = c.id WHERE t.created_by = ? ORDER BY t.updated_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    public function find($id) {
        $stmt = $this->db->prepare('SELECT t.*, c.title AS category FROM tasks t LEFT JOIN categories c ON t.category_id = c.id WHERE t.id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function create($title,$description,$categoryId,$createdBy) {
        $stmt = $this->db->prepare('INSERT INTO tasks (title,description,status,category_id,created_by,created_at) VALUES (?,?,?,?,?,NOW())');
        $stmt->execute([$title,$description,'pending',$categoryId,$createdBy]);
        return $this->db->lastInsertId();
    }
    public function updateStatus($id,$status) {
        $stmt = $this->db->prepare('UPDATE tasks SET status=?, updated_at=NOW() WHERE id=?');
        return $stmt->execute([$status,$id]);
    }
}
?>
