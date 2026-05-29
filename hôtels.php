<?php
require_once 'config/connexion.php';

// ===== AJOUTER UN HOTEL =====
if (isset($_POST['ajouter'])) {
    $nom      = mysqli_real_escape_string($conn, $_POST['nom_hot']);
    $categorie = mysqli_real_escape_string($conn, $_POST['categorie']);
    $ville    = mysqli_real_escape_string($conn, $_POST['ville']);

    $sql = "INSERT INTO HOTEL (nom_hot, categorie, ville) 
            VALUES ('$nom', '$categorie', '$ville')";
    mysqli_query($conn, $sql);
    header("Location: hôtels.php");
    exit();
}

// ===== SUPPRIMER UN HOTEL =====
if (isset($_GET['supprimer'])) {
    $id = intval($_GET['supprimer']);
    mysqli_query($conn, "DELETE FROM HOTEL WHERE num_hot = $id");
    header("Location: hôtels.php");
    exit();
}

// ===== RÉCUPÉRER TOUS LES HOTELS =====
$result = mysqli_query($conn, "SELECT * FROM HOTEL");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hôtels</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<?php include "sidebar.php"; ?>

    <main class="main">

        <header class="header">
            <h1>Gestion des Hôtels</h1>
        </header>

        <section class="content">

            <!-- FORMULAIRE -->
            <div class="card">
                <h3>Ajouter un hôtel</h3>
                <form method="POST">
                    <input type="text" name="nom_hot" placeholder="Nom de l'hôtel" required><br><br>
                    <select name="categorie" required>
                        <option value="">-- Catégorie --</option>
                        <option value="*">*</option>
                        <option value="**">**</option>
                        <option value="***">***</option>
                        <option value="****">****</option>
                        <option value="*****">*****</option>
                    </select><br><br>
                    <input type="text" name="ville" placeholder="Ville" required><br><br>
                    <button type="submit" name="ajouter">Ajouter</button>
                </form>
            </div>

            <!-- LISTE -->
            <div class="card">
                <h3>Liste des hôtels</h3>
                <table>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Ville</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($hotel = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $hotel['num_hot']; ?></td>
                            <td><?php echo $hotel['nom_hot']; ?></td>
                            <td><?php echo $hotel['categorie']; ?></td>
                            <td><?php echo $hotel['ville']; ?></td>
                            <td>
                                <a href="hôtels.php?supprimer=<?php echo $hotel['num_hot']; ?>"
                                   onclick="return confirm('Supprimer cet hôtel ?')">Supprimer</a>
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