<?php
require_once __DIR__.'/Database.php';

class Comment {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function forTask($taskId) {
        $stmt = $this->db->prepare('SELECT c.comment, c.created_at, u.name FROM task_comments c LEFT JOIN users u ON c.created_by = u.id WHERE c.task_id = ? ORDER BY c.created_at DESC');
        $stmt->execute([$taskId]);
        return $stmt->fetchAll();
    }
    public function add($taskId,$comment,$userId) {
        $stmt = $this->db->prepare('INSERT INTO task_comments (task_id,comment,created_by,created_at) VALUES (?,?,?,NOW())');
        return $stmt->execute([$taskId,$comment,$userId]);
    }
}
?>
