<?php
include 'connexion.php';

$idUtilisateur = $_SESSION['id']; // À adapter en fonction de vos variables de session

// Vérifier si l'utilisateur est un doctorant
$queryDoctorant = "SELECT * FROM doctoral WHERE id_doctorant = $idUtilisateur";
$resultDoctorant = mysqli_query($connexion, $queryDoctorant);

// Vérifier si l'utilisateur est un professeur
$queryProfesseur = "SELECT p.*, r.role AS nom_role FROM professeur p INNER JOIN roles r 
ON p.id_encadrent = r.id_encadrent WHERE p.id_encadrent = $idUtilisateur";

$resultProfesseur = mysqli_query($connexion, $queryProfesseur);

if (mysqli_num_rows($resultDoctorant) > 0) {
    // L'utilisateur est un doctorant
    // Générez le code HTML pour le menu du doctorant
    echo '
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent" style="padding-right: 200px;">
        <ul class="navbar-nav">
                <li class="nav-item" name="menu"><a class="nav-link" href="ltim.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="équipe.php">équipe LTIM</a></li>
                <li class="nav-item"><a class="nav-link" href="activités.php">Activités</a></li>
                <li class="nav-item"><a class="nav-link" href="thèse.php">Thèses</a></li>
                <li class="nav-item"><a class="nav-link" href="espace_doctoral.php">Espace Doctorant</a></li>
                <li class="nav-item"><a class="nav-link" href="forum_doctoral.php">FORUM</a></li> 
                <li class="nav-item"><a class="nav-link" href="login.php?logout=1">Déconnecter</a></li>
                </ul>
        </div>
    ';
} elseif (mysqli_num_rows($resultProfesseur) > 0) {
    // L'utilisateur est un professeur
    $row = mysqli_fetch_assoc($resultProfesseur);
    if ($row['nom_role'] == 'Directeur') {
        // Générez le code HTML pour le menu du directeur
        echo '
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent" style="padding-right: 200px;">
                <ul class="navbar-nav">
                    <li class="nav-item" name="menu"><a class="nav-link" href="LTIM.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="équipe.php">équipe LTIM</a></li>
                    <li class="nav-item"><a class="nav-link" href="activités.php">Activités</a></li>
                    <li class="nav-item"><a class="nav-link" href="thèse.php">Thèses</a></li>
                    <li class="nav-item"><a class="nav-link" href="espace_directeur.php">Espace Directeur</a></li>
                    <li class="nav-item"><a class="nav-link" href="forum_prof.php">FORUM</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Déconnecter</a></li>
                </ul>
            </div>
        ';
    } elseif ($row['nom_role'] == 'Prof') {
        // Générez le code HTML pour le menu du professeur
        echo '
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent" style="padding-right: 200px;">
                <ul class="navbar-nav">
                    <li class="nav-item" name="menu"><a class="nav-link" href="LTIM.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="équipe.php">équipe LTIM</a></li>
                    <li class="nav-item"><a class="nav-link" href="activités.php">Activités</a></li>
                    <li class="nav-item"><a class="nav-link" href="thèse.php">Thèses</a></li>
                    <li class="nav-item"><a class="nav-link" href="espace_prof.php">Espace Professeur</a></li>
                    <li class="nav-item"><a class="nav-link" href="forum_prof.php">FORUM</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Déconnecter</a></li>
                </ul>
            </div>
        ';
    } elseif ($row['nom_role'] == 'Responsable') {
        // Générez le code HTML pour le menu du responsable
        echo '
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent" style="padding-right: 200px;">
                <ul class="navbar-nav">
                    <li class="nav-item" name="menu"><a class="nav-link" href="LTIM.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="équipe.php">équipe LTIM</a></li>
                    <li class="nav-item"><a class="nav-link" href="activités.php">Activités</a></li>
                    <li class="nav-item"><a class="nav-link" href="thèse.php">Thèses</a></li>
                    <li class="nav-item"><a class="nav-link" href="espace_responsable.php">Espace Responsable</a></li>
                    <li class="nav-item"><a class="nav-link" href="forum_prof.php">FORUM</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Déconnecter</a></li>
                </ul>
            </div>
        ';
    }
}
?>
