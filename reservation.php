<?php
session_start();
require_once 'config/connexion.php';

// ===== AJOUTER UNE RESERVATION =====
if (isset($_POST['ajouter'])) {
    $num_cli  = intval($_POST['num_cli']);
    $num_ch   = intval($_POST['num_ch']);
    $date_deb = mysqli_real_escape_string($conn, $_POST['date_deb']);
    $date_fin = mysqli_real_escape_string($conn, $_POST['date_fin']);

    // Insérer dans RESERVATION
    $sql = "INSERT INTO RESERVATION (date_deb, date_fin, num_cli) 
            VALUES ('$date_deb', '$date_fin', '$num_cli')";
    mysqli_query($conn, $sql);

    // Récupérer le numéro de la réservation créée
    $num_res = mysqli_insert_id($conn);

    // Insérer dans LIGNE_RESERVATION
    $sql2 = "INSERT INTO LIGNE_RESERVATION (num_res, num_ch) 
             VALUES ('$num_res', '$num_ch')";
    mysqli_query($conn, $sql2);

    header("Location: reservation.php");
    exit();
}

// ===== SUPPRIMER UNE RESERVATION =====
if (isset($_GET['supprimer'])) {
    $id = intval($_GET['supprimer']);
    mysqli_query($conn, "DELETE FROM RESERVATION WHERE num_res = $id");
    header("Location: reservation.php");
    exit();
}

// ===== RÉCUPÉRER LES CLIENTS POUR LE FORMULAIRE =====
$clients = mysqli_query($conn, "SELECT * FROM CLIENT");

// ===== RÉCUPÉRER LES CHAMBRES POUR LE FORMULAIRE =====
$chambres = mysqli_query($conn, "SELECT C.*, H.nom_hot 
                                  FROM CHAMBRE C 
                                  JOIN HOTEL H ON C.num_hot = H.num_hot");

// ===== RÉCUPÉRER LES RÉSERVATIONS =====
$clientFilter = '';
if (isset($_SESSION['num_cli'])) {
    $clientId = intval($_SESSION['num_cli']);
    $clientFilter = "WHERE R.num_cli = $clientId";
}

$result = mysqli_query($conn, "SELECT R.num_res, R.date_deb, R.date_fin,
                                       C.nom_cli, C.prenom_cli,
                                       CH.type_ch, H.nom_hot
                                FROM RESERVATION R
                                JOIN CLIENT C ON R.num_cli = C.num_cli
                                JOIN LIGNE_RESERVATION LR ON R.num_res = LR.num_res
                                JOIN CHAMBRE CH ON LR.num_ch = CH.num_ch
                                JOIN HOTEL H ON CH.num_hot = H.num_hot
                                $clientFilter");
?>

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

            <!-- FORMULAIRE -->
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
                                <?php echo $chambre['nom_hot']; ?> — 
                                <?php echo $chambre['type_ch']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select><br><br>
                    <input type="date" name="date_deb" required><br><br>
                    <input type="date" name="date_fin" required><br><br>
                    <button type="submit" name="ajouter">Ajouter</button>
                </form>
            </div>

            <!-- LISTE -->
            <div class="card">
                <h3>Liste des réservations</h3>
                <table>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Client</th>
                            <th>Hôtel</th>
                            <th>Chambre</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($res = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $res['num_res']; ?></td>
                            <td><?php echo $res['nom_cli'] . ' ' . $res['prenom_cli']; ?></td>
                            <td><?php echo $res['nom_hot']; ?></td>
                            <td><?php echo $res['type_ch']; ?></td>
                            <td><?php echo $res['date_deb']; ?></td>
                            <td><?php echo $res['date_fin']; ?></td>
                            <td>
                                <a href="reservation.php?supprimer=<?php echo $res['num_res']; ?>"
                                   onclick="return confirm('Supprimer cette réservation ?')">Supprimer</a>
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