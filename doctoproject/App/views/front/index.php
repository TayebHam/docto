<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

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
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .container {
            margin-top: 100px;
        }
        h1, h2, h3 {
            color: #333;
        }
        p, ul {
            color: #666;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 5px 0;
            color: blue;
        }

        .buttons {
            position: absolute;
            top: 90px;
            right: 10px;
        }
        .buttons .btn {
            margin: 5px;
        }

        .imagemedecine {
            width: 200px;
            height: 200px;
            object-fit: cover;
            justify-content: space-between;
            border-radius: 50%;
        }

        .imageprincipale {
            width: 100%;
            height: 300px;
            object-fit: cover;
            justify-content: space-between;
            margin-bottom: 10px;
            margin-top: 90px;
        }
    </style>
</head>
<body>

<?php require_once(__DIR__ . '/header.php'); ?>

<div class="buttons">
    <?php if(!isset($_SESSION['email'])) { ?>
        <a href="inscription" class="btn">S'inscrire</a>
        <a href="connexion" class="btn">Connexion</a>
        <a href="admin_connexion" class="btn">Connexion medecin</a>
    <?php } else { ?>
        <a href="deconnexion" class="btn">Déconnexion</a>
    <?php } ?>   
</div>

<img class="imageprincipale" src="assets/images/imageprincipale.jpg" alt="">

<div class="container">
    <?php if(isset($_SESSION['email'])) { ?>
        <h1>Bonjour, <?php echo htmlspecialchars($_SESSION['email']); ?> !</h1>
    <?php } ?>

    <h1>Bienvenue sur notre site de prise de rendez-vous médical</h1>
    <p>Nous sommes là pour vous aider à prendre un rendez-vous avec un professionnel de la santé rapidement et facilement.</p>
    <a href="formulaire" class="btn">Prendre un rendez-vous</a>
</div>

<div class="container">
    

    <h2>À propos du Dr Dupont</h2>
    <p>Le Dr Dupont est un médecin de renom, spécialisé en médecine générale, radiologie et échographie. Il est dédié à fournir des soins de qualité à tous ses patients.</p>
    <h3>Services proposés</h3>
    <ul>
        <div class="service-item">
            <img class="imagemedecine" src="assets/images/medecine.jpg" alt="Médecine générale">
            <p>Médecine générale</p>
        </div>
        <div class="service-item">
            <img class="imagemedecine" src="assets/images/radiologie.jpg" alt="Radiologie">
            <p>Radiologie</p>
        </div>
        <div class="service-item">
            <img class="imagemedecine" src="assets/images/echo.png" alt="Échographie">
            <p>Échographie</p>
        </div>
    </ul>
   
</div>

</body>
</html>
