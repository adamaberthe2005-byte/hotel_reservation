<?php
require_once 'config/connexion.php';

// ===== AJOUTER UNE CHAMBRE =====
if (isset($_POST['ajouter'])) {
    $type   = mysqli_real_escape_string($conn, $_POST['type_ch']);
    $prix   = intval($_POST['prix_ch']);
    $num_hot = intval($_POST['num_hot']);

    $sql = "INSERT INTO CHAMBRE (type_ch, prix_ch, num_hot) 
            VALUES ('$type', '$prix', '$num_hot')";
    mysqli_query($conn, $sql);
    header("Location: chambres.php");
    exit();
}

// ===== SUPPRIMER UNE CHAMBRE =====
if (isset($_GET['supprimer'])) {
    $id = intval($_GET['supprimer']);
    mysqli_query($conn, "DELETE FROM CHAMBRE WHERE num_ch = $id");
    header("Location: chambres.php");
    exit();
}

// ===== RÉCUPÉRER LES HOTELS POUR LE FORMULAIRE =====
$hotels = mysqli_query($conn, "SELECT * FROM HOTEL");

// ===== RÉCUPÉRER TOUTES LES CHAMBRES =====
$result = mysqli_query($conn, "SELECT C.*, H.nom_hot 
                                FROM CHAMBRE C 
                                JOIN HOTEL H ON C.num_hot = H.num_hot");
?>

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

            <!-- FORMULAIRE -->
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

            <!-- LISTE -->
            <div class="card">
                <h3>Liste des chambres</h3>
                <table>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Type</th>
                            <th>Prix/nuit</th>
                            <th>Hôtel</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($chambre = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $chambre['num_ch']; ?></td>
                            <td><?php echo $chambre['type_ch']; ?></td>
                            <td><?php echo number_format($chambre['prix_ch'], 0, ',', ' '); ?> FCFA</td>
                            <td><?php echo $chambre['nom_hot']; ?></td>
                            <td>
                                <a href="chambres.php?supprimer=<?php echo $chambre['num_ch']; ?>"
                                   onclick="return confirm('Supprimer cette chambre ?')">Supprimer</a>
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