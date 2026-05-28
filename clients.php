<?php
require_once 'config/connexion.php';

// ===== AJOUTER UN CLIENT =====
if (isset($_POST['ajouter'])) {
    $nom      = mysqli_real_escape_string($conn, $_POST['nom_cli']);
    $prenom   = mysqli_real_escape_string($conn, $_POST['prenom_cli']);
    $tel      = mysqli_real_escape_string($conn, $_POST['tel_cli']);
    $email    = mysqli_real_escape_string($conn, $_POST['email_cli']);
    $mdp      = password_hash($_POST['mdp_cli'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO CLIENT (nom_cli, prenom_cli, tel_cli, email_cli, mdp_cli) 
            VALUES ('$nom', '$prenom', '$tel', '$email', '$mdp')";
    mysqli_query($conn, $sql);
    header("Location: clients.php");
    exit();
}

// ===== SUPPRIMER UN CLIENT =====
if (isset($_GET['supprimer'])) {
    $id = intval($_GET['supprimer']);
    mysqli_query($conn, "DELETE FROM CLIENT WHERE num_cli = $id");
    header("Location: clients.php");
    exit();
}

// ===== RÉCUPÉRER TOUS LES CLIENTS =====
$result = mysqli_query($conn, "SELECT * FROM CLIENT");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Clients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<?php include "sidebar.php"; ?>

    <main class="main">

        <header class="header">
            <h1>Gestion des Clients</h1>
        </header>

        <section class="content">

            <!-- FORMULAIRE -->
            <div class="card">
                <h3>Ajouter un client</h3>
                <form method="POST">
                    <input type="text" name="nom_cli" placeholder="Nom" required><br><br>
                    <input type="text" name="prenom_cli" placeholder="Prénom" required><br><br>
                    <input type="text" name="tel_cli" placeholder="Téléphone" required><br><br>
                    <input type="email" name="email_cli" placeholder="Email" required><br><br>
                    <input type="password" name="mdp_cli" placeholder="Mot de passe" required><br><br>
                    <button type="submit" name="ajouter">Ajouter</button>
                </form>
            </div>

            <!-- LISTE -->
            <div class="card">
                <h3>Liste des clients</h3>
                <table>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($client = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $client['num_cli']; ?></td>
                            <td><?php echo $client['nom_cli']; ?></td>
                            <td><?php echo $client['prenom_cli']; ?></td>
                            <td><?php echo $client['tel_cli']; ?></td>
                            <td><?php echo $client['email_cli']; ?></td>
                            <td>
                                <a href="clients.php?supprimer=<?php echo $client['num_cli']; ?>" 
                                   onclick="return confirm('Supprimer ce client ?')">Supprimer</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </section>
    </main>
</div>

</body>
</html>