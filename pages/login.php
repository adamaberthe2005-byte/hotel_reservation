<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main class="main" style="max-width:420px; margin:40px auto;">
        <section class="card">
            <h2>Connexion</h2>
            <p>Cette page de démo permet d’ouvrir l’application.</p>
            <form method="post">
                <input type="email" name="email" placeholder="Email" required><br><br>
                <input type="password" name="password" placeholder="Mot de passe" required><br><br>
                <button type="submit">Se connecter</button>
            </form>
            <p style="margin-top:12px;"><a href="../index.php">Retour à l’accueil</a></p>
        </section>
    </main>
</body>
</html>
