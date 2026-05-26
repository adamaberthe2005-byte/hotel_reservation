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

    <!-- CONTENU -->
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

                <?php
                if (!isset($_SESSION)) {
                    session_start();
                }

                if (!isset($_SESSION['clients'])) {
                    $_SESSION['clients'] = [];
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nom = $_POST['nom'];
                    $telephone = $_POST['telephone'];

                    $_SESSION['clients'][] = [
                        "nom" => $nom,
                        "telephone" => $telephone
                    ];
                }

                foreach ($_SESSION['clients'] as $client) {
                    echo "<p>".$client['nom']." - ".$client['telephone']."</p>";
                }
                ?>

            </div>

        </section>

    </main>

</div>

</body>
</html>