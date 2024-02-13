<?php
include 'connexion.php';
session_start();

$Activité = mysqli_real_escape_string($connexion,$_POST['titreActivité']);
$Conference = $_POST['conference_date'];

// Vérifier si un fichier a été sélectionné
if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] !== UPLOAD_ERR_NO_FILE) {
    $rapportTmpPath = $_FILES['fichier']['tmp_name'];
    $rapportName = time() . '_' . $_FILES['fichier']['name'];
    $rapportDestination = 'pdf_base/' . $rapportName;
    if (!move_uploaded_file($rapportTmpPath, $rapportDestination)) { 
        echo "Erreur lors du déplacement du fichier PDF ";
        exit;
    }
}

$imageTmpPath = $_FILES['image']['tmp_name'];
$imageFileName = time() . '_' . $_FILES['image']['name'];
$imageDestinationPath = 'image_base/' . $imageFileName;

if (!move_uploaded_file($imageTmpPath, $imageDestinationPath)) { 
    echo "Erreur lors du déplacement de l'image";
    exit;
}

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
        // Mettre à jour les informations du professeur dans la table 'professeur'
        $sql_activité_labos = "INSERT INTO activité_labos (titre_activité, date_conference, image_activité, fichier, date_creation)
VALUES ('$Activité', '$Conference', '$imageFileName', '$rapportName', NOW())"; // Used NOW() to get the current date and time

  if ($conn->query($sql_activité_labos) === TRUE) {
    header ('location: activité_ltim.php');
} else {
    echo "Erreur lors de l'ajout de l'activité : " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
?>