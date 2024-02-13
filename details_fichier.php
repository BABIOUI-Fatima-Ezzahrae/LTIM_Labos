<?php
include 'connexion.php';
session_start();
$id = $_SESSION['id'];
if (isset($_GET['file'])) {
    $fichierFileName = base64_decode($_GET['file']); // Décodage du nom du fichier depuis $_GET
    $fichierPath = 'pdf_base/' . $fichierFileName; // Chemin complet vers le fichier PDF

    if (file_exists($fichierPath)) {
        // Envoyer le fichier au client
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $fichierFileName . '"');
        readfile($fichierPath);
        exit;
    } else {
        echo "Le fichier n'existe pas.";
    }
} else {
    echo "Paramètre de fichier manquant.";
}
?>