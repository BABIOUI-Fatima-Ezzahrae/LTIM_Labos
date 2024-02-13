<?php
include 'connexion.php';

if (isset($_POST['submitPassword'])) {
    $idDodtorant = $_POST['id_doctoral'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        // Les mots de passe ne correspondent pas, afficher une erreur
        echo "Les mots de passe ne correspondent pas.";
    } else {
        // Hasher le nouveau mot de passe

        // Mettre à jour le mot de passe dans la base de données
        $updatePasswordQuery = "UPDATE doctoral SET pass = '$newPassword' WHERE id_doctorant = $idDodtorant";
        $result = mysqli_query($connexion, $updatePasswordQuery);

        if ($result) {
            header ('Location: information-doctoral.php?id_doctorant=' . $idDodtorant . '');
         } else {
            echo "Erreur lors de la modification du mot de passe : " . mysqli_error($connexion);
        }
    }
}elseif (isset($_POST['submitImage'])) {
    $idDodtorant = $_POST['id_doctoral'];

    // Vérifier si un fichier a été téléchargé
    if ($_FILES['image']['size'] > 0) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageFileName = time() . '_' . $_FILES['image']['name'];
        $imageDestinationPath = 'image_base/' . $imageFileName;

        if (move_uploaded_file($imageTmpPath, $imageDestinationPath)) {

            // Mettre à jour le chemin de l'image dans la base de données
            $updateImageQuery = "UPDATE doctoral SET image = '$imageFileName' WHERE id_doctorant = $idDodtorant";
            $result = mysqli_query($connexion, $updateImageQuery);

            if ($result) {
                header ('Location: information-doctoral.php?id_doctorant=' . $idDodtorant . '');
            } else {
                echo "Erreur lors de la modification de l'image : " . mysqli_error($connexion);
            }
        }
    }
}elseif (isset($_POST['submitImage'])) {
    $idDodtorant = $_POST['id_doctoral'];

    // Vérifier si un fichier a été téléchargé
    if ($_FILES['image']['size'] > 0) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageFileName = time() . '_' . $_FILES['image']['name'];
        $imageDestinationPath = 'image_base/' . $imageFileName;

        if (move_uploaded_file($imageTmpPath, $imageDestinationPath)) {

            // Mettre à jour le chemin de l'image dans la base de données
            $updateImageQuery = "UPDATE doctoral SET image = '$imageFileName' WHERE id_doctorant = $idDodtorant";
            $result = mysqli_query($connexion, $updateImageQuery);

            if ($result) {
                header ('Location: information-doctoral.php?id_doctorant=' . $idDodtorant . '');
            } else {
                echo "Erreur lors de la modification de l'image : " . mysqli_error($connexion);
            }
        }
    }
}
?>
