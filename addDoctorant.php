<?php
    include 'connexion.php';
    session_start ();

    // Récupérer d'autres informations du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $date_inscription = $_POST['date_inscription'];
    $sujet = mysqli_real_escape_string($connexion, $_POST['sujet']);
    $nom_axe = $_POST['nom_axe'];
    $CIN = $_POST['CIN'];

    // Connexion à la deuxla deuxième base de données
    $connexion_inscription = mysqli_connect('localhost', 'root', '', 'laboratoire');

    // Récupérer le mot de passe à partir de la table "inscription" dans la base "laboratoire"
    $login = $_POST['login'];
    $sqlGetPassword = "SELECT * FROM inscription WHERE login = '$login'";
    $resultPassword = mysqli_query($connexion_inscription, $sqlGetPassword);

    // Vérifier si la requête a réussi et s'il y a un enregistrement correspondant
    if ($resultPassword && mysqli_num_rows($resultPassword) > 0) {
        $rowPassword = mysqli_fetch_assoc($resultPassword);
        $password = $rowPassword['password'];

        // Récupérer id_encadrent de la session
        $id_encadrent = $_SESSION['id']; 

        // Récupérer id_équipe et id_labos à partir de la table "professeur" en utilisant id_encadrent
        $query_equipe = "SELECT id_équipe FROM professeur WHERE id_encadrent = '$id_encadrent'";
        $resultat_equipe = mysqli_query($connexion, $query_equipe);

        // Vérifier si la requête a réussi et s'il y a un enregistrement correspondant
        if ($resultat_equipe && mysqli_num_rows($resultat_equipe) > 0) {
            $rowEquipeId = mysqli_fetch_assoc($resultat_equipe);
            $id_équipe = $rowEquipeId['id_équipe'];

            
        // Déplacer l'image vers le dossier de destination
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageFileName = time() . '_' . $_FILES['image']['name'];
        $imageDestinationPath = 'image_base/' . $imageFileName;

        if (move_uploaded_file($imageTmpPath, $imageDestinationPath)) {
            // L'image a été déplacée avec succès vers le dossier 'image_base'

            // Insérer les données dans la table "doctoral" de la base "laboratoire-recherche"
            $sqlInsertDoctoral = "INSERT INTO doctoral (nom, prenom, CIN, login, pass, date_naissance, date_inscription, sujet, nom_axe, id_encadrent, id_équipe, image)
                                VALUES ('$nom', '$prenom', '$CIN', '$login', '$password', '$date_naissance', '$date_inscription', '$sujet', '$nom_axe', '$id_encadrent', '$id_équipe', '$imageFileName')";

            if (mysqli_query($connexion, $sqlInsertDoctoral)) {
                // Enregistrement réussi
                header ('Location: add_doctorant.php');
            } else {
                // Erreur lors de l'enregistrement
                echo "Erreur lors de l'enregistrement : " . mysqli_error($connexion);
            }
        } else {
            // Aucun enregistrement trouvé avec l'id_encadrent spécifié dans la table "professeur"
            echo "Aucun enregistrement trouvé avec l'id_encadrent spécifié dans la table 'professeur'.";
        }
    } else {
        // Aucun résultat trouvé avec le login spécifié dans la table "inscription"
        echo "Aucun résultat trouvé avec le login spécifié dans la table 'inscription'.";
    }
    }
    // Fermeture de la connexion à la base de données "laboratoire"
    mysqli_close($connexion);

?>
