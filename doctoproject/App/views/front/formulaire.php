


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, select {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 16px;
        }
        input[type="submit"] {
            background: #5cb85c;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #4cae4c;
        }
    </style>
</head>
<body>

<?php  require_once(__DIR__ . '/header.php'); ?>


    <div class="container">
        <h1>Prise de rendez-vous médical</h1>
        <form action="/formulaire" method="POST">

        
            <label for="firstname">Nom:</label>
            <input type="text" id="nom" name="firstname">

            <label for="lastname">Prénom:</label>
            <input type="text" id="prenom" name="lastname" >

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" >

            <label for="telephone">Téléphone:</label>
            <input type="tel" id="telephone" name="telephone" >

            <label for="service">Service:</label>
            <select id="service" name="service" >
                <option value="">Choisissez un service</option>
                <option value="consultation medecine generale">Consultation médecine générale</option>
                <option value="radiologie">radiologie</option>
                <option value="echographie">echographie</option>
               
               
            </select>

            <label for="date">Date du rendez-vous:</label>
            <input type="date" id="date" name="date" >

            <label for="heure">Heure du rendez-vous:</label>
            <input type="time" id="heure" name="heure" >

            <input type="submit" value="Prendre rendez-vous">
        </form>
    </div>
</body>
</html>
