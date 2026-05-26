<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Hôtel</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>🏨 Gestion Hôtel</h1>

        <nav>
            <a href="index.php">Accueil</a>
            <a href="pages/login.php">Connexion</a>
        </nav>
    </header>

    <main>

        <section class="hero">

            <h2>Bienvenue dans notre application de gestion hôtelière</h2>

            <p>
                Gérez les clients, chambres et réservations facilement.
            </p>

            <a href="pages/login.php">
                <button>Commencer</button>
            </a>

        </section>

    </main>

</body>

</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Hôtel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<?php include "sidebar.php"; ?>
    
    <!-- CONTENU PRINCIPAL -->
    <main class="main">
        <header class="header">
            <h1>Tableau de bord</h1>
        </header>

        <section class="content">
            <div class="card">Clients</div>
            <div class="card">Chambres</div>
            <div class="card">Réservations</div>
        </section>
    </main>

</div>

</body>
</html>