<?php
include 'connexion.php';
session_start();
$id = $_SESSION['id'];

// Récupération des données du formulaire
$nomArticle = $_POST['nom_article'];
$date = $_POST['date'];

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

    // Requête d'insertion des données dans la table "article_doctorant"
    $sql = "INSERT INTO article_doctorant (nom_article, date, id_doctorant, fichier) 
            VALUES ('$nomArticle', '$date', '$id', '$rapportName')";

    if ($conn->query($sql) === TRUE) {
        // Redirection vers la page espace_doctoral.php#article après l'insertion réussie
        header("Location: espace_doctoral.php#article");
        exit(); // Terminer le script après la redirection
    } else {
        echo "Erreur lors de l'insertion des données : " . $conn->error;
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
} }else {
    echo "Erreur lors du téléchargement du fichier.";
}
?>
