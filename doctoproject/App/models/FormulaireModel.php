<?php
namespace App\Models;
use PDO;
class FormulaireModel {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function create($firstname, $lastname, $email,  $telephone, $service, $date, $heure) {
        $stmt = $this->pdo->prepare('INSERT INTO booking (firstname, lastname, email, telephone, service, date, heure) VALUES (?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$firstname, $lastname, $email, $telephone, $service, $date, $heure]);
    }
    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM booking');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM booking WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update($id,$firstname, $lastname, $email,  $telephone, $service, $date, $heure) {
        $stmt = $this->pdo->prepare('UPDATE booking SET firstname = ?, lastname = ?, email = ?, telephone = ?, service = ?, date = ?, heure = ?, WHERE id = ?');
        return $stmt->execute([$firstname, $lastname, $email,  $telephone, $service, $date, $heure, $id]);
    }
    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM booking WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>