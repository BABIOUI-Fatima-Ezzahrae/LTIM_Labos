<?php
include 'connexion.php';
session_start();

$id_doctorant = $_POST['id_doctorant'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$login = $_POST['login'];
$date_naissance = $_POST['date_naissance'];
$date_inscription = $_POST['date_inscription'];
$sujet = $_POST['sujet'];
$nom_axe = $_POST['nom_axe'];
$id_encadrent = $_POST['id_encadrent'];

$sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";

$resultatsql = mysqli_query($connexion, $sql);
$row = mysqli_fetch_assoc($resultatsql);

$nom = $row['nom'];
$prenom = $row['prenom'];
$password = $row['pass'];

// Récupération de l'id_équipe à partir de l'id_encadrent
$query_professeur = "SELECT id_équipe FROM professeur WHERE id_encadrent = '$id_encadrent'";
$resultat_professeur = $connexion->query($query_professeur);

if ($resultEquipeId && mysqli_num_rows($resultEquipeId) > 0) {
    // L'équipe existe, récupérer son ID
    $rowEquipeId = mysqli_fetch_assoc($resultEquipeId);
    $idEquipe = $rowEquipeId['id_équipe'];
    $idLabos = $rowEquipeId['id_labos'];

    // Déplacer l'image vers le dossier de destination
    $imageTmpPath = $_FILES['image']['tmp_name'];
    $imageFileName = time() . '_' . $_FILES['image']['name'];
    $imageDestinationPath = 'image_base/' . $imageFileName;

    if (move_uploaded_file($imageTmpPath, $imageDestinationPath)) {
        // L'image a été déplacée avec succès vers le dossier 'image_base'

        // Mettre à jour les informations du professeur dans la table 'professeur'
        $sql_professeur = "UPDATE professeur SET nom = '$nom_prof', prenom = '$prenom_prof', specialite = '$specialite',
                           CIN = '$Cin', login = '$login', pass = '$password', id_équipe = '$idEquipe',
                           id_labos = '$idLabos', imags = '$imageFileName' WHERE id_encadrent = $id_prof";
        
        if (mysqli_query($connexion, $sql_professeur)) {
            // La mise à jour a réussi
            echo "Les informations du professeur ont été modifiées avec succès.";
        } else {
            // La mise à jour a échoué
            echo "Erreur lors de la modification des informations du professeur : " . mysqli_error($connexion);
        }
    } else {
        // Erreur lors du déplacement de l'image
        echo "Erreur lors du déplacement de l'image vers le dossier de destination.";
    }
} else {
    // L'équipe n'existe pas
    echo "L'équipe spécifiée n'existe pas.";
}
?>
