<?php

$servername = "localhost"; // Nom du serveur MySQL
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL
$dbname = "laboratoire-recherche"; // Nom de la base de données

// Établir la connexion à la base de données
$connexion = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier si la connexion a réussi
if (!$connexion) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

?>