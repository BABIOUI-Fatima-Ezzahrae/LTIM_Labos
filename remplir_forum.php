<?php
include 'connexion.php';
session_start();
$IdProf = $_SESSION['id'];

// Récupération des données du formulaire
$Titre_Sujet = $_POST['sujet'];
$Description_Sujet = $_POST['description'];
$dateAjout = date('Y-m-d H:i:s');

$sql = "INSERT INTO forum (titre, id_encadrent, date_creation, sujet_forum) VALUES ('$Titre_Sujet', '$IdProf', '$dateAjout', '$Description_Sujet')";
$resultat = mysqli_query($connexion, $sql);
if ($resultat) {
    header("Location: forum_prof.php");
} else {
    echo 'Erreur lors de l"ajout du sujet : ' . mysqli_error($connexion);
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>