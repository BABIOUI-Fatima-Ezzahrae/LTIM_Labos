<?php
include 'connexion.php';
session_start();

$Formation = mysqli_real_escape_string($connexion,$_POST['titreFormation']);

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


// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
    $sql_formation_transversale = "INSERT INTO formation_transversale (name_formation, fichier, date_creation) 
    VALUES ('$Formation', '$rapportName', NOW())";
    
    if ($conn->query($sql_formation_transversale) === TRUE) {
        header ('location: activité_ltim.php');
    } else {
    echo "Erreur lors de l'ajout de l'activité : " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
?>