<?php
include 'connexion.php';

// Récupérer l'ID du doctorant à supprimer à partir de la requête GET
$idProf = $_GET['id_encadrent'];
$idEncadrent = $_SESSION['id'];

// Requête pour supprimer le doctorant de la base de données
$sqlSupprimer = "DELETE FROM professeur WHERE id_encadrent = $idProf";
$resultatSupprimer = mysqli_query($connexion, $sqlSupprimer);

$sql = "SELECT * FROM roles WHERE id_encadrent = $idEncadrent";
$resultatRole = mysqli_query($connexion, $sql);

if ($resultatRole && mysqli_num_rows($resultatRole) > 0) {
    $row = mysqli_fetch_assoc($resultatRole);
    $role = $row['role'];

    // Redirection en fonction du rôle de l'utilisateur
    if ($role == 'Responsable') {
        header('Location: espace_responsable.php');
    } elseif ($role == 'Directeur') {
        header('Location: espace_directeur.php');
    }else{
        // Gérer les erreurs de suppression
    echo 'Une erreur s\'est produite lors de la suppression du doctorant.';
    }
} else {
    // Gérer les erreurs de suppression
    echo 'Une erreur s\'est produite lors de la suppression du doctorant.';
}

mysqli_close($connexion);
?>