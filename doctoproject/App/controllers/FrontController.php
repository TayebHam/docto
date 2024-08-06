<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\FormulaireModel;
use App\Models\AdminModel;

class FrontController {

    private $userModel;
    private $formulaireModel;
    private $adminModel;

    public function __construct() {
        global $pdo; // Assurez-vous que $pdo est globalement accessible
        $this->userModel = new User($pdo);
        $this->formulaireModel = new FormulaireModel($pdo);
        $this->adminModel = new AdminModel($pdo);
    }

    // Méthodes de votre contrôleur
    public function index() {
        require_once '../app/views/front/index.php';
    }

    public function admin_connexion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $errors = [];

            if (empty($email) || empty($password)) {
                $errors[] = 'Veuillez remplir tous les champs.';
            } else {
                $admin = $this->adminModel->getByEmail($email);

                if ($admin) {
                    if ($password == $admin['password']) {
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['id'] = $admin['id'];
                        $_SESSION['role'] = $admin['role'];
                        
                        // Redirection vers le tableau de bord
                        header('Location: /dashboard');
                        exit;
                    } else {
                        $errors[] = 'Mot de passe incorrect.';
                    }
                } else {
                    $errors[] = 'Aucun utilisateur trouvé avec cet email.';
                }
            }

            if (!empty($errors)) {
                session_start();
                $_SESSION['errors'] = $errors;
                header('Location: /admin_connexion');
                exit;
            }
        } else {
            require_once '../app/views/front/admin_connexion.php';
        }
    }



    

   

    public function apropos() {
        require_once '../app/views/front/apropos.php';
    }

    public function articles($lastposts = []) {
        require_once '../app/views/front/articles.php';
    }

    public function services() {
        require_once '../app/views/front/services.php';
    }

    

    public function connexion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $errors = [];
            if (empty($email) || empty($password)) {
                $errors[] = 'Veuillez remplir tous les champs.';
            } else {
                $user = $this->userModel->getByEmail($email);

                if ($user) {
                    if ($password == $user['password']) {
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['role'] = $user['role'];
                        if ($user['role'] == 1) {
                            header('Location: /admin');
                        } else {
                            header('Location: /');
                        }
                        exit;
                    } else {
                        $errors[] = 'Mot de passe incorrect.';
                    }
                } else {
                    $errors[] = 'Aucun utilisateur trouvé avec cet email.';
                }
            }
            if (!empty($errors)) {
                session_start();
                $_SESSION['errors'] = $errors;
                header('Location: /connexion'); // Redirige vers la page de connexion pour afficher les erreurs
                exit;
            }
        } else {
            require_once '../app/views/front/connexion.php';
        }
    }


    public function deconnexion() {
        session_start();
        session_destroy();
        header('Location: /');
        exit();
    }

    public function inscription() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = $_POST['first_name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $birthday = $_POST['birthday'];
            $city_of_birth = $_POST['city_of_birth'];
            $address = $_POST['address'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $role = $_POST['role']; // Ajout de la récupération du rôle

            // Validation des champs
            if (empty($first_name) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
                throw new \Exception("Tous les champs obligatoires doivent être remplis.");
            }

            // Validation du mot de passe
            if ($password !== $confirm_password) {
                throw new \Exception("Les mots de passe ne correspondent pas.");
            }

            // Liste des rôles valides
            $validRoles = ['medecin', 'patient'];
            if (!in_array($role, $validRoles)) {
                throw new \InvalidArgumentException("Le rôle spécifié est invalide.");
            }

            // Hachage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Création de l'utilisateur
            if ($role === 'medecin') {
                $this->adminModel->create($first_name, $lastname, $email, $hashed_password, $birthday, $city_of_birth, $address, $role);
            } else {
                $this->userModel->create($first_name, $lastname, $email, $hashed_password, $birthday, $city_of_birth, $address, $role);
            }

            header('Location: /');
            exit;
        } else {
            require_once '../app/views/front/inscription.php';
        }
    }

    public function formulaire() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            $service = $_POST['service'];
            $date = $_POST['date'];
            $heure = $_POST['heure'];

            // Validation des champs
            if (empty($firstname) || empty($lastname) || empty($email) || empty($telephone) || empty($service) || empty($date) || empty($heure)) {
                throw new \Exception("Tous les champs doivent être remplis.");
            }

            $this->formulaireModel->create($firstname, $lastname, $email, $telephone, $service, $date, $heure);
            header('Location: /');
            exit;
        } else {
            require_once '../app/views/front/formulaire.php';
        }
    }
}

?>
