<?php $page = "chambres"; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chambres</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <?php include "sidebar.php"; ?>

    <main class="main">

        <header class="header">
            <h1>Gestion des Chambres</h1>
        </header>

        <section class="content">

            <div class="card">
                <h3>Ajouter une chambre</h3>

                <form method="POST">
                    <select name="type_ch" required>
        <option value="">-- Type de chambre --</option>
        <option value="Simple">Simple</option>
        <option value="Double">Double</option>
        <option value="Suite">Suite</option>
    </select><br><br>
    <input type="number" name="prix_ch" placeholder="Prix par nuit (FCFA)" required><br><br>
    <select name="num_hot" required>
        <option value="">-- Sélectionner un hôtel --</option>
        <?php while ($hotel = mysqli_fetch_assoc($hotels)) : ?>
            <option value="<?php echo $hotel['num_hot']; ?>">
                <?php echo $hotel['nom_hot']; ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>
    <button type="submit" name="ajouter">Ajouter</button>
                </form>
            </div>

            <div class="card">
                <h3>Liste des chambres</h3>
                <p>Aucune base de données encore connectée.</p>
            </div>

        </section>

    </main>

</div>

</body>
</html>