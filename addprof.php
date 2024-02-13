<?php
include 'connexion.php';

// Récupérer les valeurs du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$specialite = $_POST['specialite'];
$CIN = $_POST['CIN'];
$date_embauche = $_POST['date_embauche'];
$Equipe = $_POST['equipe'];
$login = $_POST['login'];

// Connexion à la deuxla deuxième base de données
$connexion_inscription = mysqli_connect('localhost', 'root', '', 'laboratoire');

// Requête pour récupérer les informations de la table "inscription"
$sqlGetInscriptions = "SELECT login, nom, prenom, password FROM inscription";
$resultInscriptions = mysqli_query($connexion_inscription, $sqlGetInscriptions);

// Boucle pour insérer les enregistrements dans la table "professeur"
while ($row = mysqli_fetch_assoc($resultInscriptions)) {
    $inscription_login = $row['login'];
    $inscription_nom = $row['nom'];
    $inscription_prenom = $row['prenom'];
    $inscription_password = $row['password'];

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

            // Insérer le professeur dans la table 'professeur'
            $sql_professeur = "INSERT INTO professeur (nom, prenom, specialite, CIN, login, pass, date_embauche, id_équipe, id_labos, imags)
    VALUES ('$nom', '$prenom', '$specialite', '$CIN', '$login', '$password', '$date_embauche', '$idEquipe', '$idLabos', '$imageFileName')";

// Exécuter la requête d'insertion dans la table 'professeur'
if (mysqli_query($connexion, $sql_professeur)) {
    // Succès de l'insertion dans la table 'professeur'

    // Récupérer l'ID du dernier enregistrement inséré dans la table 'professeur'
    $id_professeur = mysqli_insert_id($connexion);

    // Définir le rôle du professeur comme "professeur" dans la table 'role'
    $sql_role = "INSERT INTO roles (id_encadrent, nom, prenom, role)
        VALUES ('$id_professeur', '$nom', '$prenom', 'professeur')";

    // Exécuter la requête d'insertion dans la table 'role'
    if (mysqli_query($connexion, $sql_role)) {
        // Succès de l'insertion dans la table 'role'
        header("Location: espace_responsable.php");
    } else {
        // Erreur lors de l'insertion dans la table 'role', afficher le message d'erreur
        echo "Erreur lors de l'ajout du rôle du professeur : " . mysqli_error($connexion);
    }
} else {
    // Erreur lors de l'insertion dans la table 'professeur', afficher le message d'erreur
    echo "Erreur lors de l'ajout du professeur : " . mysqli_error($connexion);
}
        }
}
}
// Fermer la connexion à la base de données
mysqli_close($connexion_inscription);
mysqli_close($connexion);
?>