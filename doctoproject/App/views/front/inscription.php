
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        body {
            text-align: center;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-container {
            background-color: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
        }
        .signup-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"],
        .signup-container input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .signup-container .btn {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .signup-container .btn:hover {
            background-color: #0056b3;
        }
        .signup-container .login-link {
            display: block;
            margin-top: 10px;
            color: #007BFF;
            text-decoration: none;
        }
        .signup-container .login-link:hover {
            text-decoration: underline;
        }

        .signup-container .login-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 600px) {
            .signup-container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Inscription</h2>
    <form method="POST" action="/inscription">
        <input type="text" name="first_name" placeholder="Prénom" required>
        <input type="text" name="lastname" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="date" name="birthday" placeholder="Date de naissance" required>
        <input type="text" name="city_of_birth" placeholder="Ville de naissance" required>
        <input type="text" name="address" placeholder="Adresse" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>

        <select name="role" required>
            <option value="">Sélectionner un rôle</option>
            <option value="patient">Patient</option>
            <option value="medecin">Médecin</option>
        </select>

        <button type="submit" class="btn">S'inscrire</button>
    </form>
    <a href="connexion" class="login-link">Déjà inscrit? Connectez-vous</a>
</div>
