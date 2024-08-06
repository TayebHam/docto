<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\User; // Assurez-vous que ce modèle existe
use PDO;

class AdminController {
    private $adminModel;
    private $user;

    public function __construct(PDO $dbConnection) {
        $this->adminModel = new AdminModel($dbConnection);
        $this->user = new User($dbConnection);
    }

    public function dashboard() {
        require_once '../app/views/front/dashboard.php';
    }

    public function deconnexionMedecin() {
        session_start();
        unset($_SESSION['email']);
        unset($_SESSION['id']);
        unset($_SESSION['role']);
        session_destroy();
        header('Location: /dashboard');
        exit();
    }

}
?>
