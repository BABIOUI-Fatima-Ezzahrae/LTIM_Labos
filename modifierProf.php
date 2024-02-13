<?php
include 'connexion.php';
session_start();

$id_prof = $_POST['idProf'];
$nom_prof = $_POST['nom'];
$prenom_prof = $_POST['prenom'];
$specialite = $_POST['specialite'];
$Cin = $_POST['CIN'];
$Equipe = $_POST['équipe'];
$login = $_POST['login'];
$role = $_POST['role'];

$sql = "SELECT p.*, e.équipe, r.role
        FROM professeur p
        INNER JOIN équipes e ON p.id_équipe = e.id_équipe
        INNER JOIN roles r ON p.id_encadrent= r.id_encadrent
        WHERE p.id_encadrent = $id_prof";
$resultatsql = mysqli_query($connexion, $sql);
$row = mysqli_fetch_assoc($resultatsql);

$nom = $row['nom'];
$prenom = $row['prenom'];
$password = $row['pass'];

// Requête pour récupérer l'ID de l'équipe
$sqlGetEquipeId = "SELECT id_équipe, id_labos FROM équipes WHERE équipe = '$Equipe'";
$resultEquipeId = mysqli_query($connexion, $sqlGetEquipeId);

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
            header ("Location: espace_directeur.php");
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
