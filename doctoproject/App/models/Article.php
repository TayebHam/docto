<?php
namespace App\Models;
use PDO;
class Article {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM articles');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getLast() {
        $stmt = $this->pdo->query('SELECT * FROM articles ORDER BY updatedAt DESC LIMIT 3');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM articles WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($title, $content, $image) {
        $stmt = $this->pdo->prepare('INSERT INTO articles (title, content, image) VALUES (?, ?, ?)');
        return $stmt->execute([$title, $content, $image]);
    }
    public function update($id, $title, $content, $image) {
        $stmt = $this->pdo->prepare('UPDATE articles SET title = ?, content = ?, image = ? WHERE id = ?');
        return $stmt->execute([$title, $content, $image, $id]);
    }
    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM articles WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>