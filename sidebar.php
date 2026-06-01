<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<aside class="sidebar">
    <h2>Hôtel App</h2>
    <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="clients.php">Clients</a></li>
        <li><a href="chambres.php">Chambres</a></li>
        <li><a href="hôtels.php">Hôtels</a></li>
        <li><a href="reservation.php">Réservations</a></li>
        <?php if (isset($_SESSION['num_cli'])) : ?>
            <li><a href="logout.php">Déconnexion</a></li>
        <?php endif; ?>
    </ul>
</aside>