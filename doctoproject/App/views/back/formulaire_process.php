<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "docto_project"; 
$conn = new mysqli($servername, $username, $password, $dbname);

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$service = $_POST['service'];
$date = $_POST['date'];
$heure = $_POST['heure'];

// Requête pour insérer les informations dans la base de données
$sql = "INSERT INTO booking (nom, prenom, email, telephone, service, date, heure) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $nom, $prenom, $email, $telephone, $service, $date, $heure);

if ($stmt->execute()) {
    echo "Rendez-vous pris avec succès !";
    // Redirigez l'utilisateur vers une page de confirmation
    header("Location: ../front/index.php");
    exit();
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
