<?php
include 'connexion.php';
session_start();
$idDoctorant = $_SESSION['id'];

// Récupération des données du formulaire
$nomThèse = $_POST['nom_thèse'];
$dateSoutenance = $_POST['date_soutenance'];
$nomComplet = $_POST['nom_prenom'];
$jury = $_POST['Jury'];
if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] !== UPLOAD_ERR_NO_FILE) {
    $rapportTmpPath = $_FILES['fichier']['tmp_name']; // Chemin temporaire du fichier
    $rapportName = time() . '_' . $_FILES['fichier']['name']; // Nouveau nom du fichier
    $rapportDestination = 'pdf_base/' . $rapportName; // Chemin complet vers le dossier de destination

    if (move_uploaded_file($rapportTmpPath, $rapportDestination)) {
        // Déplacer le fichier vers le dossier de destination
        // Connexion à la base de données
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Requête de mise à jour de la date de soutenance dans la table "doctoral"
        $sqlUpdateDoctoral = "UPDATE doctoral SET date_soutenance = '$dateSoutenance' WHERE id_doctorant = '$idDoctorant'";

        if ($conn->query($sqlUpdateDoctoral) === TRUE) {
            echo "Date de soutenance mise à jour avec succès dans la table doctoral.";
        } else {
            echo "Erreur lors de la mise à jour de la date de soutenance dans la table doctoral : " . $conn->error;
        }

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connexion échouée : " . $conn->connect_error);
        }

        // Récupération de l'ID de l'encadrent
        $sqlEncadrent = "SELECT id_encadrent FROM professeur WHERE CONCAT(nom, ' ', prenom) = '$nomComplet' OR CONCAT(prenom, ' ', nom) = '$nomComplet'";
        $resultEncadrent = $conn->query($sqlEncadrent);

        if ($resultEncadrent->num_rows > 0) {
            $rowEncadrent = $resultEncadrent->fetch_assoc();
            $idEncadrent = $rowEncadrent['id_encadrent'];
            $rapport_escaped = mysqli_real_escape_string($conn, $rapportName);
            // Requête d'insertion des données dans la table "thèses"
            $sqlTheses = "INSERT INTO thèses (thèse, id_doctorant, id_encadrent, fichier) 
                          VALUES ('$nomThèse', '$idDoctorant', '$idEncadrent', '$rapport_escaped')";

            if ($conn->query($sqlTheses) === TRUE) {
                $idThese = $conn->insert_id;

                // Insertion des données du jury dans la table "jury_thèse"
                foreach ($jury as $membreJury) {
                    $sqlGetJuryID = "SELECT id_encadrent FROM professeur WHERE CONCAT(nom, ' ', prenom) = '$membreJury' OR CONCAT(prenom, ' ', nom) = '$membreJury'";
                    $resultJuryID = $conn->query($sqlGetJuryID);

                    if ($resultJuryID->num_rows > 0) {
                        $rowJuryID = $resultJuryID->fetch_assoc();
                        $idJury = $rowJuryID['id_encadrent'];

                        $sqlJury = "INSERT INTO jurys (id_thèse, id_encadrent) 
                                    VALUES ('$idThese', '$idJury')";
                        $conn->query($sqlJury);
                    } else {
                        echo "Membre du jury introuvable : $membreJury";
                    }
                }
                
                header("Location: espace_doctoral.php#thèse");
                echo "Ajout effectué avec succès.";
                exit();
            } else {
                header("Location: espace_doctoral.php#thèse");
                echo "Erreur lors de l'insertion des données : " . $conn->error;
            }
        } else {
            header("Location: espace_doctoral.php#thèse");
            echo "Encadrent introuvable.";
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
    } else {
        header("Location: espace_doctoral.php#thèse");
        echo "Erreur lors du téléchargement du fichier.";
    }
} else {
    header("Location: espace_doctoral.php#thèse");
    echo "Erreur : aucun fichier sélectionné.";
}
?>
