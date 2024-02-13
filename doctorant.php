<?php
include 'connexion.php';
session_start ();
// Récupérer l'identifiant du doctorant depuis l'URL
if (isset($_GET['id'])) {
    $idDoctorant = $_GET['id'];

    // Effectuer la requête SQL pour récupérer les détails du doctorant
    $sql = "SELECT * FROM doctoral WHERE id = $idDoctorant";
    $resultat = mysqli_query($connexion, $sql);

    if (mysqli_num_rows($resultat) > 0) {
        $row = mysqli_fetch_assoc($resultat);

        // Afficher les détails du doctorant
        echo '<div>
                <h2>'.$row['nom'].' '.$row['prenom'].'</h2>
                <p>Spécialité: '.$row['specialite'].'</p>
                <p>Autres détails...</p>
                <!-- Ajoutez ici d"autres éléments de la page du doctorant -->
              </div>';
    } else {
        echo "Doctorant non trouvé.";
    }
} else {
    echo "Identifiant du doctorant non spécifié.";
}
?>
