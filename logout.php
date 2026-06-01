<?php
session_start();

// Détruit toute la session et redirige vers la page de connexion
$_SESSION = [];
session_destroy();
header('Location: pages/login.php');
exit();
