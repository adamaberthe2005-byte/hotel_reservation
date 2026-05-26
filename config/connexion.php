<?php

// Paramètres de connexion
$host     = "localhost";
$user     = "root";
$password = "";
$database = "hotel_reservation";

// Connexion à la base de données
$conn = mysqli_connect($host, $user, $password, $database);

// Vérification de la connexion
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Encodage UTF-8 pour les caractères spéciaux (accents...)
mysqli_set_charset($conn, "utf8mb4");

?>
