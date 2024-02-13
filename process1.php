<?php
include 'connexion.php';
session_start();
$id = $_SESSION['id'];
// Récupération des données du formulaire
$nomActivité = $_POST['nom'];
$date = $_POST['date'];

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

        // Requête d'insertion des données dans la table "autre_activités"
        $sql = "INSERT INTO autre_activités (nom, date, id_doctorant, fichier) 
                VALUES ('$nomActivité', '$date', '$id', '$rapportName')";

        if ($conn->query($sql) === TRUE) {
            header("Location: espace_doctoral.php#commun");
            exit();
        } else {
            echo "Erreur lors de l'insertion des données : " . $conn->error;
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
    } else {
        echo "Erreur lors du déplacement du fichier.";
    }
}
?>
