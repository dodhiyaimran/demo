<?php
require_once __DIR__.'/Database.php';

class Category {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function all() {
        $stmt = $this->db->query('SELECT * FROM categories ORDER BY title');
        return $stmt->fetchAll();
    }
    public function find($id) {
        $stmt = $this->db->prepare('SELECT * FROM categories WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function create($title,$description) {
        $stmt = $this->db->prepare('INSERT INTO categories (title, description) VALUES (?,?)');
        $stmt->execute([$title,$description]);
        return $this->db->lastInsertId();
    }
    public function update($id,$title,$description) {
        $stmt = $this->db->prepare('UPDATE categories SET title=?, description=? WHERE id=?');
        return $stmt->execute([$title,$description,$id]);
    }
    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM categories WHERE id=?');
        return $stmt->execute([$id]);
    }
}
?>
