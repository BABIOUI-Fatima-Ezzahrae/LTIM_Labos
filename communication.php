<?php
include 'connexion.php';
session_start();
$id = $_SESSION['id'];

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit_communication'])) {
    // Récupération des données du formulaire
    $nomCommunication = $_POST['nom_commun'];
    $nature = $_POST['nature'];
    $date = $_POST['date'];
    $lieu = $_POST['lieu'];

    // Vérifier si un fichier a été sélectionné
if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] !== UPLOAD_ERR_NO_FILE) {
    $rapportTmpPath = $_FILES['fichier']['tmp_name']; // Chemin temporaire du fichier
    $rapportName = time() . '_' . $_FILES['fichier']['name']; // Nouveau nom du fichier
    $rapportDestination = 'pdf_base/' . $rapportName; // Chemin complet vers le dossier de destination

// Déplacer le fichier vers le dossier de destination
if (move_uploaded_file($rapportTmpPath, $rapportDestination)) {
            // Connexion à la base de données
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Connexion échouée : " . $conn->connect_error);
            }

            // Requête d'insertion des données dans la table "communication"
            $sql = "INSERT INTO communication (nom_communic, nature, date, lieu, fichier, id_doctorant) 
                    VALUES ('$nomCommunication', '$nature', '$date', '$lieu', '$rapportName', '$id')";

            if ($conn->query($sql) === TRUE) {
                header("Location: espace_doctoral.php#commun");
                exit(); // Terminer le script après la redirection
            } else {
                echo "Erreur lors de l'insertion des données : " . $conn->error;
            }

            // Fermeture de la connexion à la base de données
            $conn->close();
        } else {
            echo "Erreur lors du téléchargement du fichier.";
            exit; // Terminer le script si le téléchargement du fichier a échoué
        }
    } else {
        echo "Aucun fichier sélectionné.";
        exit; // Terminer le script si aucun fichier n'a été sélectionné
    }
}
?>
