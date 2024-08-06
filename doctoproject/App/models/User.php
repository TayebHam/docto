<?php
namespace App\Models;
use PDO;

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM user');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($first_name, $lastname, $email, $password, $birthday, $city_of_birth, $address, $role) {
        $stmt = $this->pdo->prepare('INSERT INTO user (first_name, lastname, email, password, birthday, city_of_birth, address, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$first_name, $lastname, $email, $password, $birthday, $city_of_birth, $address, $role]);
    }

    public function getByEmail($email) {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $first_name, $lastname, $email, $password, $birthday, $city_of_birth, $address, $role) {
        $stmt = $this->pdo->prepare('UPDATE user SET first_name = ?, lastname = ?, email = ?, password = ?, birthday = ?, city_of_birth = ?, address = ?, WHERE id = ?');
        return $stmt->execute([$first_name, $lastname, $email, $password, $birthday, $city_of_birth, $address, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM user WHERE id = ?');
        return $stmt->execute([$id]);
    }
    
  

    public function addUser($name, $email) {
        $stmt = $this->db->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
        $stmt->execute(['name' => $name, 'email' => $email]);
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function getAllAppointments() {
        $stmt = $this->db->query('SELECT * FROM booking');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
