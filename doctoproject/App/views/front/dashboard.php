<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
        header('Location: /admin_connexion');
        exit();
    }
}

$patients = [];
$appointments = [];
$services = []; // Initialiser la variable des services

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=docto_project', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des services pour le formulaire de modification et d'ajout de services
    $stmt = $pdo->query('SELECT id, nom FROM services');
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les patients
    $stmt = $pdo->query('SELECT id, first_name, lastname, email FROM user');
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les rendez-vous
    $stmt = $pdo->query('SELECT id, date, heure, service, firstname, lastname FROM booking');
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Traitement des formulaires POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['modify_hours'])) {
            // Modification des horaires d'ouverture
            $service_id = $_POST['service_id'];
            $horaire_ouverture = $_POST['horaire_ouverture'];
            
            $stmt = $pdo->prepare('UPDATE services SET horaire_ouverture = ? WHERE id = ?');
            $stmt->execute([$horaire_ouverture, $service_id]);
            
            header('Location: /dashboard');
            exit();
        } elseif (isset($_POST['add_service'])) {
            // Ajout d'un nouveau service
            $nom = $_POST['nom'];
           
            $horaire_ouverture = $_POST['horaire_ouverture'];

            $stmt = $pdo->prepare('INSERT INTO services (nom, horaire_ouverture) VALUES (?, ?)');
            $stmt->execute([$nom, $horaire_ouverture]);

            header('Location: /dashboard');
            exit();
        }elseif (isset($_POST['delete_service'])) {
            // Suppression d'un service
            $id = $_POST['id'];
            $stmt = $pdo->prepare('DELETE FROM services WHERE id = ?');
            $stmt->execute([$id]);
            header('Location: /dashboard');
            exit();
        } elseif (isset($_POST['add_patient'])) {
            // Ajout d'un patient
            $first_name = $_POST['first_name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $stmt = $pdo->prepare('INSERT INTO user (first_name, lastname, email) VALUES (?, ?, ?)');
            $stmt->execute([$first_name, $lastname, $email]);
            header('Location: /dashboard');
            exit();
        } elseif (isset($_POST['delete_patient'])) {
            // Suppression d'un patient
            $id = $_POST['id'];
            $stmt = $pdo->prepare('DELETE FROM user WHERE id = ?');
            $stmt->execute([$id]);
            header('Location: /dashboard');
            exit();
        } elseif (isset($_POST['add_appointment'])) {
            // Ajout d'un rendez-vous
            $date = $_POST['date'];
            $heure = $_POST['heure'];
            $service = $_POST['service'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $stmt = $pdo->prepare('INSERT INTO booking (date, heure, service, firstname, lastname) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$date, $heure, $service, $firstname, $lastname]);
            header('Location: /dashboard');
            exit();
        } elseif (isset($_POST['delete_appointment'])) {
            // Suppression d'un rendez-vous
            $id = $_POST['id'];
            $stmt = $pdo->prepare('DELETE FROM booking WHERE id = ?');
            $stmt->execute([$id]);
            header('Location: /dashboard');
            exit();
        }
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 50px;
        }

        h1 {
            color: #333;
        }

        .logout {
            float: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .logout-button, .add-button, .delete-button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border: none;
        }

        .add-form, .delete-form, .add-appointment-form {
            margin-top: 20px;
        }

        .add-form input, .delete-form input, .add-appointment-form input {
            padding: 10px;
            margin: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tableau de Bord Administrateur</h1>
        <form method="post" action="/" class="dashboard">
            <button type="submit" class="logout-button">Déconnexion</button>
        </form>

        <h2>Patients</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($patients)): ?>
                    <?php foreach ($patients as $patient): ?>
                        <tr>
                            <td><?= htmlspecialchars($patient['id']) ?></td>
                            <td><?= htmlspecialchars($patient['first_name'] . ' ' . $patient['lastname']) ?></td>
                            <td><?= htmlspecialchars($patient['email']) ?></td>
                            <td>
                                <form method="post" action="/dashboard" class="delete-form">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($patient['id']) ?>">
                                    <input type="hidden" name="delete_patient" value="1">
                                    <button type="submit" class="delete-button">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Aucun patient trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Ajouter un patient</h2>
        <form method="post" action="/dashboard" class="add-form">
            <input type="hidden" name="add_patient" value="1">
            <input type="text" name="first_name" placeholder="Prénom" required>
            <input type="text" name="lastname" placeholder="Nom" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" class="add-button">Ajouter</button>
        </form>

        <h2>Rendez-vous</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Service</th>
                    <th>Patient</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($appointments)): ?>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?= htmlspecialchars($appointment['id']) ?></td>
                            <td><?= htmlspecialchars($appointment['date']) ?></td>
                            <td><?= htmlspecialchars($appointment['heure']) ?></td>
                            <td><?= htmlspecialchars($appointment['service']) ?></td>
                            <td><?= htmlspecialchars($appointment['firstname'] . ' ' . $appointment['lastname']) ?></td>
                            <td>
                                <form method="post" action="/dashboard" class="delete-form">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($appointment['id']) ?>">
                                    <input type="hidden" name="delete_appointment" value="1">
                                    <button type="submit" class="delete-button">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Aucun rendez-vous trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Ajouter un rendez-vous</h2>
        <form method="post" action="/dashboard" class="add-appointment-form">
            <input type="hidden" name="add_appointment" value="1">
            <input type="date" name="date" required>
            <input type="time" name="heure" required>
            <input type="text" name="firstname" placeholder="Prénom du patient" required>
            <input type="text" name="lastname" placeholder="Nom du patient" required>

            <label for="service">Service:</label>
            <select id="service" name="service" >
                <option value="">Choisissez un service</option>
                <option value="consultation medecine generale">Consultation médecine générale</option>
                <option value="radiologie">radiologie</option>
                <option value="echographie">echographie</option>
               
               
            </select>
            <button type="submit" class="add-button">Ajouter</button>
        </form>

     
     <h2>Modifier les Horaires d'Ouverture</h2>
     <form method="post" action="/dashboard" class="modify-hours-form">
        <input type="hidden" name="modify_hours" value="1">
        <label for="service_id">Service :</label>
        <select name="service_id" required>
            <?php foreach ($services as $service): ?>
                <option value="<?= htmlspecialchars($service['id']) ?>"><?= htmlspecialchars($service['nom']) ?></option>
            <?php endforeach; ?>
        </select>
        <label for="horaire_ouverture">Nouveaux horaires :</label>
        <input type="text" name="horaire_ouverture" placeholder="Ex: Lun - Vendredi 9h30 - 17h00, Sam 9h30 - 12h30" required>
        <button type="submit" class="modify-button">Modifier</button>
     </form>


     <h2>Ajouter un Nouveau Service</h2>
    <form method="post" action="/dashboard" class="add-service-form">
        <input type="hidden" name="add_service" value="1">
        <label for="nom">Nom du Service :</label>
        <input type="text" name="nom" placeholder="Nom du service" required>
         <label for="horaire_ouverture">Horaires d'Ouverture :</label>
        <input type="text" name="horaire_ouverture" placeholder="Ex: Lun - Vendredi 9h30 - 17h00, Sam 9h30 - 12h30" required>
        <button type="submit" class="add-button">Ajouter Service</button>
    </form>


    <h2>Services Existants</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Horaires d'Ouverture</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $services): ?>
                        <tr>
                            <td><?= htmlspecialchars($services['id']) ?></td>
                            <td><?= htmlspecialchars($services['nom']) ?></td>
                            
                            <td>
                                <form method="post" action="/dashboard" class="delete-form">
                                    <button type="submit" class="delete-button">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Aucun service trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>
