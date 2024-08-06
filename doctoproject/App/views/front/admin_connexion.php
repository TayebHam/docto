<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../models/AdminModel.php';

use App\Models\AdminModel;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $errors = [];

    if (empty($email) || empty($password)) {
        $errors[] = 'Veuillez remplir tous les champs.';
    } else {
        $pdo = new PDO('mysql:host=localhost;dbname=docto_project', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $adminModel = new AdminModel($pdo);
        $admin = $adminModel->getByEmail($email);

        if ($admin && password_verify($password, $admin['password'])) {
            if ($admin['role'] === 'admin') {
                $_SESSION['email'] = $admin['email'];
                $_SESSION['id'] = $admin['id'];
                $_SESSION['role'] = $admin['role'];
                header('Location: /dashboard');
                exit();
            } else {
                $errors[] = 'Vous n\'êtes pas autorisé à accéder à cette section.';
            }
        } else {
            $errors[] = 'Email ou mot de passe incorrect';
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: /admin_connexion');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Médecin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #666;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Connexion Médecin</h1>
        <?php
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<p class='error'>$error</p>";
            }
            unset($_SESSION['errors']);
        }
        ?>
        <form method="post" action="/admin_connexion">
            <label>Email :</label>
            <input type="email" name="email" required>
            <br>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
            <br>
            <input type="submit" value="Connexion">
        </form>
    </div>
</body>
</html>
