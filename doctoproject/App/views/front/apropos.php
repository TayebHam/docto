<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos</title>
    <link rel="stylesheet" href="css/styles.css">
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
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .container {
            margin-top: 50px;
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
        }

        .equipe{
            border-radius:50%;   
        }



    </style>
</head>
<body>

<?php  require_once(__DIR__ . '/header.php'); ?>

<div class="container">
    <h1>Dr Dupont</h1>

    <img class= "dupont" src="assets/images/dupont.png" alt="">
    <p>Le Dr Dupont est un médecin dévoué avec une vaste expérience et des qualifications dans divers domaines de la médecine.</p>
    
    <h2>Parcours et qualifications</h2>
    <p>Le Dr Dupont a obtenu son diplôme de médecine à l'Université de Paris. Il a ensuite poursuivi des spécialisations en radiologie et échographie, complétant des stages et des formations avancées dans des hôpitaux renommés.</p>
    <p>Il est certifié en médecine générale, radiologie et échographie, et participe régulièrement à des conférences et des formations continues pour rester à jour avec les dernières avancées médicales.</p>
    
    <h2>Membres de l'équipe</h2>
    <p>Le cabinet du Dr Dupont est composé d'une équipe dédiée de professionnels de la santé qui soutiennent et assistent le Dr Dupont dans ses tâches quotidiennes.</p>
    <ul>
        <div>
        <img class= equipe src="assets/images/infirmiere.png" alt="">
        <p><strong>Marie Lemoine</strong> - Infirmière en chef</p></div>

        <div>
        <img class=equipe src="assets/images/radiologue.jpg" alt="">
        <p><strong>Jean-Pierre Martin</strong> - Technicien en radiologie</p></div>
        <div>
        <img class=equipe src="assets/images/assistante.png" alt="">
        <p><strong>Sophie Dubois</strong> - Assistante administrative</p></div>

    </ul>
</div>

</body>
</html>
