<?php
include 'connexion.php';
session_start();
$id = $_SESSION['id'];

// Récupération des données du formulaire
$intitule = $_POST['intitule'];
$description = $_POST['desc_projet'];
$duree = $_POST['durée'];
$nature = $_POST['nature'];

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

        // Récupérer le nom du fichier
        $rapport_escaped = mysqli_real_escape_string($conn, $rapportName);

        // Requête d'insertion des données dans la table "projet"
        $sql = "INSERT INTO projet (id_encadrent, intitule, desc_projet, durée, nature, fichier) 
                VALUES ('$id', '$intitule', '$description', '$duree', '$nature', '$rapport_escaped')";

        if ($conn->query($sql) === TRUE) {
            header("Location: espace_prof.php#projet");
            exit();
        } else {
            echo "Erreur lors de l'insertion des données : " . $conn->error;
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
} else {
    echo "Veuillez sélectionner un fichier.";
}
?>
