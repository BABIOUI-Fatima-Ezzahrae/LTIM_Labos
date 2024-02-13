<?php
include 'connexion.php';
session_start();
$IdDoctorant = $_SESSION['id'];

// Récupération des données du formulaire
$Contenue= $_POST['reponse'];
$dateAjout = date('Y-m-d H:i:s');
$IdForum = $_POST['forum_id'];

$sql = "INSERT INTO messages (id_doctorant, id_forum, contenue, date_creation) VALUES ('$IdDoctorant', '$IdForum', '$Contenue', '$dateAjout')";
$resultat = mysqli_query($connexion, $sql);
if ($resultat) {
    header("Location: forum_doctoral.php");
} else {
    echo 'Erreur lors de l"ajout du sujet : ' . mysqli_error($connexion);
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>