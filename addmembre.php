<?php
include 'connexion.php';

// Récupérer les valeurs du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$specialite = $_POST['specialite'];
$CIN = $_POST['CIN'];
$date_embauche = $_POST['date_embauche'];
$Equipe = $_POST['equipe'];
$role = $_POST['rôle'];
$login = $_POST['login'];

// Connexion à la première base de données "laboratoire" pour vérifier l'existence du professeur
$connexion_laboratoire = mysqli_connect('localhost', 'root', '', 'laboratoire');

// Requête pour récupérer les informations de la table "inscription"
$sqlGetInscriptions = "SELECT login, password FROM inscription WHERE login = '$login'";
$resultInscriptions = mysqli_query($connexion_laboratoire, $sqlGetInscriptions);

// Vérifier si le professeur existe dans la table "inscription"
if (mysqli_num_rows($resultInscriptions) > 0) {
    // Récupérer les informations du professeur depuis la table "inscription"
    $row = mysqli_fetch_assoc($resultInscriptions);
    $login = $row['login'];
    $password = $row['password'];

    // Fermer la connexion à la première base de données "laboratoire"
    mysqli_close($connexion_laboratoire);

    // Connexion à la deuxième base de données "laboratoire-recherche"
    $connexion_laboratoire_recherche = mysqli_connect('localhost', 'root', '', 'laboratoire-recherche');

    // Requête pour récupérer l'ID de l'équipe
    $sqlGetEquipeId = "SELECT id_équipe, id_labos FROM équipes WHERE équipe = '$Equipe'";
    $resultEquipeId = mysqli_query($connexion_laboratoire_recherche, $sqlGetEquipeId);

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
            if (mysqli_query($connexion_laboratoire_recherche, $sql_professeur)) {
                // Succès de l'insertion dans la table 'professeur'

                // Récupérer l'ID du dernier enregistrement inséré dans la table 'professeur'
                $id_professeur = mysqli_insert_id($connexion_laboratoire_recherche);

                // Définir le rôle du professeur dans la table 'role'
                $sql_role = "INSERT INTO roles (id_encadrent, nom, prenom, role)
                    VALUES ('$id_professeur', '$nom', '$prenom', '$role')";

                // Exécuter la requête d'insertion dans la table 'role'
                if (mysqli_query($connexion_laboratoire_recherche, $sql_role)) {
                    // Succès de l'insertion dans la table 'role'
                    header ("Location: espace_directeur.php");
                } else {
                    // Erreur lors de l'insertion dans la table 'role', afficher le message d'erreur
                    echo "Erreur lors de l'ajout du rôle du professeur : " . mysqli_error($connexion_laboratoire_recherche);
                }
            } else {
                // Erreur lors de l'insertion dans la table 'professeur', afficher le message d'erreur
                echo "Erreur lors de l'ajout du professeur : " . mysqli_error($connexion_laboratoire_recherche);
            }
        } else {
            // Erreur lors du déplacement de l'image, afficher le message d'erreur
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        // L'équipe n'existe pas, afficher le message d'erreur
        echo "L'équipe sélectionnée n'existe pas.";
    }

    // Fermer la connexion à la deuxième base de données "laboratoire-recherche"
    mysqli_close($connexion_laboratoire_recherche);
} else {
    // Le professeur n'existe pas dans la table "inscription"
    echo "Le professeur avec le login '$login' n'existe pas dans la base de données 'laboratoire'.";
}
?>
