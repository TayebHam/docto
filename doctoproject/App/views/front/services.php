<?php
// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=docto_project', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des services
    $stmt = $pdo->query('SELECT nom, horaire_ouverture FROM services');
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Services</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .images-service {
            display: flex;
            align-items: center;
            justify-content: start;
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
        }
        .images-service img {
            width: 100px;
            height: 100px;
            margin-right: 20px;
            border-radius: 50%;
        }
        .images-service div {
            text-align: left;
        }
        .images-service h3 {
            margin: 0 0 10px 0;
            color: #007BFF;
        }
        .images-service p {
            margin: 0;
            color: #666;
        }
    </style>
</head>

<body>
    <?php require_once(__DIR__ . '/header.php'); ?>

    <div class="container">
        <h1>Nos Services</h1>

        <?php foreach ($services as $services): ?>
           
                    <h3><?= htmlspecialchars($services['nom']) ?></h3>   
                    <p>Horaire d'ouverture</p>
                    <p><?= nl2br(htmlspecialchars($services['horaire_ouverture'])) ?></p>
                
        <?php endforeach; ?>
    </div>
</body>
</html>
