<?php
include 'connexion.php';

$sql = "SELECT id_labos, nom, description FROM labos";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Initialiser le tableau $labos
    $labos = array();

    // Parcourir les lignes de résultat
    while ($row = mysqli_fetch_assoc($result)) {
        // Traiter les données
        $id = $row["id_labos"];
        $nom = $row["nom"];
        $description = $row["description"];

        // Ajouter les données dans le tableau $labos
        $labos[] = array(
            "id" => $id,
            "nom" => $nom,
            "description" => $description
        );
    }
} else {
    echo "Aucun résultat trouvé.";
}

mysqli_close($conn);
?>
