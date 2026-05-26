<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <?php include "sidebar.php"; ?>

    <main class="main">

        <header class="header">
            <h1>Gestion des Réservations</h1>
        </header>

        <section class="content">

            <div class="card">
                <h3>Nouvelle réservation</h3>

                <form method="POST">
                      <select name="num_cli" required>
        <option value="">-- Sélectionner un client --</option>
        <?php while ($client = mysqli_fetch_assoc($clients)) : ?>
            <option value="<?php echo $client['num_cli']; ?>">
                <?php echo $client['nom_cli'] . ' ' . $client['prenom_cli']; ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>
    <select name="num_ch" required>
        <option value="">-- Sélectionner une chambre --</option>
        <?php while ($chambre = mysqli_fetch_assoc($chambres)) : ?>
            <option value="<?php echo $chambre['num_ch']; ?>">
                Chambre <?php echo $chambre['num_ch']; ?> — <?php echo $chambre['type_ch']; ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>
    <input type="date" name="date_deb" required><br><br>
    <input type="date" name="date_fin" required><br><br>
    <button type="submit" name="ajouter">Ajouter</button>
                </form>
            </div>

            <div class="card">
                <h3>Liste des réservations</h3>
                <p>Aucune réservation enregistrée.</p>
            </div>

        </section>

    </main>

</div>

</body>
</html>