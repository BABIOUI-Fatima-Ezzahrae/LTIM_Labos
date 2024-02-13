<?php
include 'connexion.php';
$login = $_POST['login'];
$pass = $_POST['pass'];

$requete_professeur = "SELECT p.*, r.role AS nom_role FROM professeur p INNER JOIN roles r ON p.id_encadrent = r.id_encadrent WHERE p.login = '$login' AND p.pass='$pass'";
$resultat_professeur = mysqli_query($connexion, $requete_professeur);

if (mysqli_num_rows($resultat_professeur) > 0) {
    $row = mysqli_fetch_assoc($resultat_professeur);
    if ($row['nom_role'] == 'Directeur') {
        session_start();
        $_SESSION['id'] = $row['id_encadrent'];
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
        header("Location: espace_directeur.php");
        //echo "Connexion réussie en tant que directeur.";
    } elseif ($row['nom_role'] == 'Responsable') {
        session_start();
        $_SESSION['id'] = $row['id_encadrent'];
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
       header("Location: espace_responsable.php");
        // echo "Connexion réussie en tant que responsable.";
    } else {
        session_start();
        $_SESSION['id'] = $row['id_encadrent'];
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION['equipe_id'] = $row['id_équipe'];
        header("Location: espace_prof.php");
        //echo "Connexion réussie en tant que professeur.";
        exit;
    }
} else {
    $requete_doctoral = "SELECT d.*, p.nom AS nom_professeur, p.prenom AS prenom_professeur FROM doctoral d INNER JOIN professeur p ON d.id_encadrent = p.id_encadrent WHERE d.login = '$login' AND d.pass = '$pass'";
$stmt = mysqli_prepare($connexion, $requete_doctoral);
mysqli_stmt_execute($stmt);
$resultat_doctoral = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultat_doctoral) > 0) {
    $doctoral = mysqli_fetch_assoc($resultat_doctoral);
    session_start();
    $_SESSION['id'] = $doctoral['id_doctorant'];
    $_SESSION['nom'] = $doctoral['nom'];
    $_SESSION['prenom'] = $doctoral['prenom'];
    $_SESSION['date_naissance'] = $doctoral['date_naissance'];
    $_SESSION['date_inscription'] = $doctoral['date_inscription'];
    $_SESSION['id_encadrent'] = $doctoral['id_encadrent'];
    $_SESSION['nom_professeur'] = $doctoral['nom_professeur'];
    $_SESSION['prenom_professeur'] = $doctoral['prenom_professeur'];
    
    header("Location: espace_doctoral.php");
    //echo "Connexion réussie en tant que doctorant.";

} else {
    echo "Échec de la connexion. Veuillez vérifier vos identifiants.";
}

}

mysqli_close($connexion);
?>