<?php
include 'connexion.php';
session_start();
$idDirecteur = $_SESSION['id'];

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nomEquipe = $_POST['équipe'];
    $nombreAxes = $_POST['nombreAxes'];
    $axes = $_POST['axes'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    $imageTmpPath = $_FILES['image']['tmp_name'];
    $imageFileName = time() . '_' . $_FILES['image']['name'];
    $imageDestinationPath = 'image_base/' . $imageFileName;

    if (move_uploaded_file($imageTmpPath, $imageDestinationPath)) {

        // Récupérer les informations de labos et id_labos à partir de la table professeur
        $sqlLabos = "SELECT l.nom, p.id_labos 
                    FROM professeur p 
                    JOIN labos l ON p.id_labos = l.id_labos 
                    WHERE p.id_encadrent = $idDirecteur";
        $resultLabos = $conn->query($sqlLabos);

        if ($resultLabos === false) {
            echo "Erreur de requête SQL : " . $conn->error;
        } elseif ($resultLabos->num_rows > 0) {
            $rowLabos = $resultLabos->fetch_assoc();
            $labos = $rowLabos['nom'];
            $idLabos = $rowLabos['id_labos'];

            // Insérer l'équipe dans la table "équipes"
            $stmt = $conn->prepare("INSERT INTO équipes (équipe, labos, id_labos, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $nomEquipe, $labos, $idLabos, $imageFileName);

            if ($stmt->execute()) {
                $idEquipe = $stmt->insert_id;
                // Insérer les axes dans la table "axes"
                $stmtAxes = $conn->prepare("INSERT INTO axes (id_équipe, nom_axe) VALUES (?, ?)");
                $stmtAxes->bind_param("is", $idEquipe, $nomAxe);

                foreach ($axes as $axe) {
                    $nomAxe = $axe;
                    if ($stmtAxes->execute()) {
                    } else {
                        echo "Erreur lors de l'ajout de l'axe : " . $stmtAxes->error;
                    }
                }
                $message = "Équipe ajoutée avec succès";

                // Redirection vers la page espace_directeur.php avec le message
                header("Location: espace_directeur.php");
                exit();
            } else {
                echo "Erreur lors de l'ajout de l'équipe : " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Aucun laboratoire trouvé pour ce directeur.";
        }

        $conn->close();
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}
?>
