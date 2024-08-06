<?php

namespace App\Models;

use PDO;

class AdminModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($first_name, $lastname, $email, $password, $birthday, $city_of_birth, $address, $role) {
        $stmt = $this->pdo->prepare('INSERT INTO admin (first_name, lastname, email, password, birthday, city_of_birth, address, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$first_name, $lastname, $email, $password, $birthday, $city_of_birth, $address, $role]);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM admin WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPatient($first_name, $lastname, $email) {
        $stmt = $this->pdo->prepare('INSERT INTO user (first_name, lastname, email) VALUES (?, ?, ?)');
        return $stmt->execute([$first_name, $lastname, $email]);
    }

    public function deletePatient($id) {
        $stmt = $this->pdo->prepare('DELETE FROM user WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function addAppointment($date, $heure, $service, $firstname, $lastname) {
        $stmt = $this->pdo->prepare('INSERT INTO booking (date, heure, service, first_name, lastname) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$date, $heure, $service, $firstname, $lastname]);
    }

    public function deleteAppointment($id) {
        $stmt = $this->pdo->prepare('DELETE FROM booking WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function getAllPatients() {
        $stmt = $this->pdo->query('SELECT * FROM user');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAppointments() {
        $stmt = $this->pdo->query('SELECT * FROM booking');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
