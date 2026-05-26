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
                    <input type="text" name="numero" placeholder="Numéro de chambre" required><br><br>
                    <input type="text" name="type" placeholder="Type (simple, double...)" required><br><br>
                    <button type="submit">Ajouter</button>
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