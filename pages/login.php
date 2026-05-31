<?php
session_start();
require_once '../config/connexion.php';

// ===== CONNEXION =====
if (isset($_POST['se_connecter'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mdp   = $_POST['password'];

    $sql    = "SELECT * FROM CLIENT WHERE email_cli = '$email'";
    $result = mysqli_query($conn, $sql);
    $client = mysqli_fetch_assoc($result);

    if ($client && password_verify($mdp, $client['mdp_cli'])) {
        $_SESSION['client']    = $client;
        $_SESSION['num_cli']   = $client['num_cli'];
        $_SESSION['nom_cli']   = $client['nom_cli'];
        header("Location: ../reservation.php");
        exit();
    } else {
        $erreur = "Email ou mot de passe incorrect !";
    }
}
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

            <?php if (isset($erreur)) : ?>
                <p style="color:red;"><?php echo $erreur; ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="email" name="email" placeholder="Email" required><br><br>
                <input type="password" name="password" placeholder="Mot de passe" required><br><br>
                <button type="submit" name="se_connecter">Se connecter</button>
            </form>
            <p style="margin-top:12px;"><a href="../index.php">Retour à l'accueil</a></p>
        </section>
    </main>
</body>
</html>