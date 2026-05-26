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
                    <input type="text" name="client" placeholder="Nom client" required><br><br>
                    <input type="text" name="chambre" placeholder="Numéro chambre" required><br><br>
                    <input type="date" name="date" required><br><br>
                    <button type="submit">Réserver</button>
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