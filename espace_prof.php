<?php
include 'connexion.php';
session_start ();
$idprof = $_SESSION['id'];
$nomprof = $_SESSION['nom'];
$prenomprof = $_SESSION['prenom'];
$sql = "SELECT * FROM professeur WHERE id_encadrent = $idprof";
$resultatsql = mysqli_query($connexion,$sql);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title><?php echo $prenomprof . ' ' . $nomprof ?></title>
    <!-- Stylesheets & Fonts -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i%7CRajdhani:400,600,700"
        rel="stylesheet">
    <!-- Plugins Stylesheets -->
    <link rel="stylesheet" href="assets/css/loader/loaders.css">
    <link rel="stylesheet" href="assets/css/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/aos/aos.css">
    <link rel="stylesheet" href="assets/css/swiper/swiper.css">
    <link rel="stylesheet" href="assets/css/lightgallery.min.css">
    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Responsive Stylesheet -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <style>
        .mr-4{
            width: 60px;
            height: 60px;
        }
        .services {
  width: 100%;
  margin-top: 20px;
}

.services table {
  width: 100%;
  border-collapse: collapse;
  background-color: #afe3d7;
}

.services th,
.services td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
  text-align: center;
}
.services a{
    color:  rgba(24, 9, 53);
    font-size: 16px;
}
.services a:hover{
    color: #fff;
    font-size: 16px;
    text-decoration: none;
}

.services th {
  background-color: #f2f2f2;
  color: rgba(24, 9, 53);
}

.services td:hover {
    background-color: rgba(24, 9, 53, 0.77);
}
    /* Styles pour le formulaire */
    .projet form {
        width: 300px;
        margin: 0 auto;
    }

    .projet label {
        display: inline-block;
        width: 100px;
        margin-top: 10px;
    }

    .projet input[type="text"],
    select,
    input[type="time"] {
        display: inline-block;
        width: 180%;
        padding: 5px;
        margin-left: -99px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 14px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #afe3d7;
        color: rgba(24, 9, 53);
        border: none;
        border-radius: 20px 0 20px 0;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: rgba(24, 9, 53, 0.77);
        color: #fff;
    }
</style>
</head>

<body>
    <!-- Loader Start -->
    <div class="css-loader">
        <div class="loader-inner line-scale d-flex align-items-center justify-content-center"></div>
    </div>
    <!-- Loader End -->
    <!-- Header Start -->
    <header class="position-absolute w-100" style="margin-top:0%;">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="home.php" style="margin-top: -2%; margin-left: -9%;"><img src="assets/images/logo1.png" alt="Multipurpose"></a>
                <?php include 'menu.php' ?>
            </nav>
        </div>
    </header>
    <!-- Header End -->
    <!-- Hero Start -->
    <section class="hero" style="height:30em;">
        <div class="container">
            <div class="row">
                <div class="col-12 offset-md-1 col-md-11">
                    <div class="swiper-container hero-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide slide-content d-flex align-items-center">
                                <div class="single-slide">
                                    <h1 data-aos="fade-right" data-aos-delay="200" style="margin-top:-15%">Laboratoire de Technologie de l’Information et Modélisation (LTIM)
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Hero End -->
    <!-- Call To Action Start -->
    <section class="cta" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="cta-content d-xl-flex align-items-center justify-content-around text-center text-xl-left">
                <div class="content" data-aos="fade-right" data-aos-delay="200">
                    <?php
                    $idprof = $_SESSION['id'];
                    $sql = "SELECT * FROM professeur WHERE id_encadrent = $idprof";
                    $resultatsql = mysqli_query($connexion, $sql);
                    if (mysqli_num_rows($resultatsql) > 0) {
                        $row = mysqli_fetch_assoc($resultatsql);
                    
                        // Récupérer les informations du professeur
                        $nomProfesseur = $row['nom'];
                        $prenomProfesseur = $row['prenom'];
                        $loginProfesseur = $row['login'];
                        $imagsProfesseur = $row['imags'];
                        $idEquipe = $row['id_équipe'];
                                        $sqlEquipe = "SELECT * FROM équipes WHERE id_équipe = $idEquipe";
                                        $resultatEquipe = mysqli_query($connexion, $sqlEquipe);
                                    // Vérifier si la requête a renvoyé des résultats
                                    if (mysqli_num_rows($resultatEquipe) > 0) {
                                        $rowEquipe = mysqli_fetch_assoc($resultatEquipe);
                                        // Accéder aux données de l'équipe
                                        $nomequipe = $rowEquipe['équipe'];
                        // Afficher les informations du professeur
                        echo "<h2>$nomequipe </h2>";
                        echo '<h4><a href="information-prof.php?id_encadrent=' . $idprof . '">Pr. ' . $nomProfesseur . ' ' . $prenomProfesseur . '</a></h4>';
                        echo "<a href='$loginProfesseur' style='color: #afe3d7;'>$loginProfesseur</a>";
                    }
                }
                    ?>
                </div>
                <div class="subscribe-btn" data-aos="fade-left" data-aos-delay="400" data-aos-offset="0">
                <?php
$idprof = $_SESSION['id'];
$sql = "SELECT * FROM professeur WHERE id_encadrent = $idprof";
$resultatsql = mysqli_query($connexion, $sql);

if (mysqli_num_rows($resultatsql) > 0) {
    $row = mysqli_fetch_assoc($resultatsql);
    $imageFileName = $row['imags'];
    $imagePath = 'image_base/' . $imageFileName;

    // Vérifier si le fichier image existe
    if (file_exists($imagePath)) {
        // Lire les données binaires de l'image
        $imageData = file_get_contents($imagePath);
        // Encoder les données en base64
        $imageBase64 = base64_encode($imageData);

        // Afficher l'image à partir des données encodées en base64
        echo '<img class="mr-4" src="data:image/jpeg;base64,' . $imageBase64 . '" alt="Image">';
    } else {
        $idprof = $_SESSION['id'];
        $sql = "SELECT * FROM professeur WHERE id_encadrent = $idprof";
        $resultatsql = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($resultatsql) > 0) {
            $row = mysqli_fetch_assoc($resultatsql);
            echo '<img class="mr-4" src="data:image/jpeg;base64,' . base64_encode($row['imags']) . '" alt="Image">';
        } else {
            echo 'Image introuvable.';
        }
    }
}
?>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action End -->
<br><br><br><br>
    <!-- membre doctorant Start -->
    <section class="services">
    <div class="title text-center">
            <h1 class="title-blue"><a name="member" style="font-size: 60px;">Doctorants Membre</a></h1>
        </div>
        <div>
            <!-- Formulaire pour sélectionner l'année -->
        <div style="display: flex; justify-content: center; align-items: center;">
            <div style="margin-right: 30px;">
        <a data-aos="fade-right" data-aos-delay="900" href="add_doctorant.php" class="btn btn-primary">ADD Doctorant</a>
        </div>
    <div style="margin-right: 30px;">
        <form method="POST" action="">
            <input type="text" name="annee" id="annee" placeholder="Année (ex: 2023)" required>
            <button type="submit">Rechercher par année</button>
        </form>
    </div>
    <div style="margin-right: 30px;">
        <form method="POST" action="">
            <input type="text" name="nom" id="nom" placeholder="Nom du doctorant" required>
            <button type="submit">Rechercher par nom</button>
        </form>
    </div>
    <div>
        <?php 
        
        // Requête SQL pour compter le nombre d'articles
        $sql = "SELECT COUNT(*) AS total
        FROM article_doctorant ad
        JOIN doctoral d ON ad.id_doctorant = d.id_doctorant
        WHERE d.id_encadrent = $idprof";
        // Exécution de la requête
        $result = $connexion->query($sql);
        // Vérification des résultats
        if ($result && $result->num_rows > 0) {
        // Récupération du nombre total d'articles
        $row = $result->fetch_assoc();
        $totalArticles = $row["total"];

        // Affichage du nombre d'articles
            echo '<h5>Nombre d"articles :</h5><p style="color: black; font-size: 16px; font-weight: bold;">' . $totalArticles . '</p>';
        }
    ?>
    </div>
</div>
<br><br>
            <?php
// Vérifier si le formulaire a été soumis
if (isset($_POST["annee"])) {
    // Récupérer la valeur de l'année saisie par l'utilisateur
    $annee = $_POST["annee"];
    $idEncadrent = $_SESSION['id'];

    // Vérifier si l'année est valide
    if (!empty($annee) && is_numeric($annee)) {
        // Requête SQL pour sélectionner les doctorants en fonction de l'année et de l'id_encadrent
        $sqlDoctoral = "SELECT * FROM doctoral WHERE YEAR(date_inscription) = $annee AND id_encadrent = $idEncadrent";
        $resultatDoctoral = mysqli_query($connexion, $sqlDoctoral);

        // Vérifier si des résultats ont été trouvés
        if (mysqli_num_rows($resultatDoctoral) > 0) {
            $counter = 0;
            echo '<table>
                <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Année-inscription</th>
                <th>Article</th>
                <th>Communication</th>
                <th>Formation Transversale</th>
                <th>Autre Activités</th>
                <th colspan="3" style="text-align: center;">Actions</th>
                </tr>';
        
                while ($rowDoctoral = mysqli_fetch_assoc($resultatDoctoral)) {
                    $idDoctorant = $rowDoctoral['id_doctorant'];
                    $nomDoctorant = $rowDoctoral['nom'];
                    $prenomDoctorant = $rowDoctoral['prenom'];
                    $inscrire = $rowDoctoral['date_inscription'];
                    $anneeActuelle = date("Y");
                    $etat = $anneeActuelle - intval($inscrire);
                
                    // Requête pour récupérer le total des articles
                    $sqlArticles = "SELECT COUNT(*) AS total_articles FROM article_doctorant WHERE id_doctorant = $idDoctorant";
                    $resultArticles = mysqli_query($connexion, $sqlArticles);
                    $rowArticles = mysqli_fetch_assoc($resultArticles);
                    $totalArticles = $rowArticles['total_articles'];
                
                    // Récupérer la durée de la formation depuis le formulaire
                    $sqlDureeFormations = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(temp))) AS total_duree FROM formations WHERE id_doctorant = $idDoctorant";
                    $resultDureeFormations = mysqli_query($connexion, $sqlDureeFormations);
                    $rowDureeFormations = mysqli_fetch_assoc($resultDureeFormations);
                    $totalDureeFormations = $rowDureeFormations['total_duree'];

                    // Affichage de la durée totale
                    $dureeTotale = $totalDureeFormations;

                    // Requête pour récupérer le total des activités
                    $sqlActivites = "SELECT COUNT(*) AS total_activites FROM autre_activités WHERE id_doctorant = $idDoctorant";
                    $resultActivites = mysqli_query($connexion, $sqlActivites);
                    $rowActivites = mysqli_fetch_assoc($resultActivites);
                    $totalActivites = $rowActivites['total_activites'];
                
                    // Requête pour récupérer le total des communications
                    $sqlCommunications = "SELECT COUNT(*) AS total_communications FROM communication WHERE id_doctorant = $idDoctorant";
                    $resultCommunications = mysqli_query($connexion, $sqlCommunications);
                    $rowCommunications = mysqli_fetch_assoc($resultCommunications);
                    $totalCommunications = $rowCommunications['total_communications'];
                
                    echo '<tr>
                        <td><a href="prof_doctoral.php?id_doctorant=' . $idDoctorant . '">' . $idDoctorant . '</a></td>
                        <td>' . $nomDoctorant . '</td>
                        <td>' . $prenomDoctorant . '</td>
                        <td>' . $etat . '</td>
                        <td>' . $totalArticles . '</td>
                        <td>' . $totalCommunications . '</td>
                        <td>'.$dureeTotale.'</td>
                        <td>' . $totalActivites . '</td>
                        <td><a href="afficher_doctorant.php?id_doctorant=' . $idDoctorant . '">informations</a></td>
                        <td><a href="modifier_doctorant.php?id_doctorant=' . $idDoctorant . '">Modifier</a></td>
                        <td><a href="supprimer_doctorant.php?id_doctorant=' . $idDoctorant . '">Supprimer</a></td>
                    </tr>';
                
                    $counter++;
                }
            echo '</table>';

        } else {
            echo "Aucun doctorant trouvé pour l'année $annee et l'encadrent $idEncadrent.";
        }
    } else {
        echo "Veuillez saisir une année valide.";
    }
}elseif (isset($_POST["nom"])) {
    // Récupérer la valeur du nom du doctorant saisi par l'utilisateur
    $nomDoctorant = $_POST['nom'];
    $idEncadrent = $_SESSION['id'];

    // Requête SQL pour sélectionner les doctorants en fonction du nom et de l'id_encadrent
    $sqlDoctoral = "SELECT * FROM doctoral WHERE nom = '$nomDoctorant' AND id_encadrent = $idEncadrent";
    $resultatDoctoral = mysqli_query($connexion, $sqlDoctoral);

    // Vérifier si des résultats ont été trouvés
    if (mysqli_num_rows($resultatDoctoral) > 0) {
        $counter = 0;
        echo '<table>
            <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Année-inscription</th>
            <th>Article</th>
            <th>Communication</th>
            <th>Formation Transversale</th>
            <th>Autre Activités</th>
            <th colspan="3" style="text-align: center;">Actions</th>
            </tr>';
    
            while ($rowDoctoral = mysqli_fetch_assoc($resultatDoctoral)) {
                $idDoctorant = $rowDoctoral['id_doctorant'];
                $nomDoctorant = $rowDoctoral['nom'];
                $prenomDoctorant = $rowDoctoral['prenom'];
                $inscrire = $rowDoctoral['date_inscription'];
                $anneeActuelle = date("Y");
                $etat = $anneeActuelle - intval($inscrire);
            
                // Requête pour récupérer le total des articles
                $sqlArticles = "SELECT COUNT(*) AS total_articles FROM article_doctorant WHERE id_doctorant = $idDoctorant";
                $resultArticles = mysqli_query($connexion, $sqlArticles);
                $rowArticles = mysqli_fetch_assoc($resultArticles);
                $totalArticles = $rowArticles['total_articles'];
            
                // Récupérer la durée de la formation depuis le formulaire
                $sqlDureeFormations = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(temp))) AS total_duree FROM formations WHERE id_doctorant = $idDoctorant";
                $resultDureeFormations = mysqli_query($connexion, $sqlDureeFormations);
                $rowDureeFormations = mysqli_fetch_assoc($resultDureeFormations);
                $totalDureeFormations = $rowDureeFormations['total_duree'];

                // Affichage de la durée totale
                $dureeTotale = $totalDureeFormations;

                // Requête pour récupérer le total des activités
                $sqlActivites = "SELECT COUNT(*) AS total_activites FROM autre_activités WHERE id_doctorant = $idDoctorant";
                $resultActivites = mysqli_query($connexion, $sqlActivites);
                $rowActivites = mysqli_fetch_assoc($resultActivites);
                $totalActivites = $rowActivites['total_activites'];
            
                // Requête pour récupérer le total des communications
                $sqlCommunications = "SELECT COUNT(*) AS total_communications FROM communication WHERE id_doctorant = $idDoctorant";
                $resultCommunications = mysqli_query($connexion, $sqlCommunications);
                $rowCommunications = mysqli_fetch_assoc($resultCommunications);
                $totalCommunications = $rowCommunications['total_communications'];
            
                echo '<tr>
                    <td><a href="prof_doctoral.php?id_doctorant=' . $idDoctorant . '">' . $idDoctorant . '</a></td>
                    <td>' . $nomDoctorant . '</td>
                    <td>' . $prenomDoctorant . '</td>
                    <td>' . $etat . '</td>
                    <td>' . $totalArticles . '</td>
                    <td>' . $totalCommunications . '</td>
                    <td>'.$dureeTotale.'</td>
                    <td>' . $totalActivites . '</td>
                    <td><a href="afficher_doctorant.php?id_doctorant=' . $idDoctorant . '">informations</a></td>
                    <td><a href="modifier_doctorant.php?id_doctorant=' . $idDoctorant . '">Modifier</a></td>
                    <td><a href="supprimer_doctorant.php?id_doctorant=' . $idDoctorant . '">Supprimer</a></td>
                </tr>';
            
                $counter++;
            }
    
        echo '</table>';
    }else {
        echo "Aucun doctorant trouvé";
    }
}else {
    $sqlDoctoral = "SELECT * FROM doctoral WHERE id_encadrent = $idprof";
        $resultatDoctoral = mysqli_query($connexion, $sqlDoctoral);

        // Vérifier si des résultats ont été trouvés
        if (mysqli_num_rows($resultatDoctoral) > 0) {
            $counter = 0;
            echo '<table>
                <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Année-inscription</th>
                <th>Article</th>
                <th>Communication</th>
                <th>Formation Transversale</th>
                <th>Autre Activités</th>
                <th colspan="3" style="text-align: center;">Actions</th>
                </tr>';
        
                while ($rowDoctoral = mysqli_fetch_assoc($resultatDoctoral)) {
                    $idDoctorant = $rowDoctoral['id_doctorant'];
                    $nomDoctorant = $rowDoctoral['nom'];
                    $prenomDoctorant = $rowDoctoral['prenom'];
                    $inscrire = $rowDoctoral['date_inscription'];
                    $anneeActuelle = date("Y");
                    $etat = $anneeActuelle - intval($inscrire);
                
                    // Requête pour récupérer le total des articles
                    $sqlArticles = "SELECT COUNT(*) AS total_articles FROM article_doctorant WHERE id_doctorant = $idDoctorant";
                    $resultArticles = mysqli_query($connexion, $sqlArticles);
                    $rowArticles = mysqli_fetch_assoc($resultArticles);
                    $totalArticles = $rowArticles['total_articles'];
                
                    // Récupérer la durée de la formation depuis le formulaire
                    $sqlDureeFormations = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(temp))) AS total_duree FROM formations WHERE id_doctorant = $idDoctorant";
                    $resultDureeFormations = mysqli_query($connexion, $sqlDureeFormations);
                    $rowDureeFormations = mysqli_fetch_assoc($resultDureeFormations);
                    $totalDureeFormations = $rowDureeFormations['total_duree'];

                    // Affichage de la durée totale
                    $dureeTotale = $totalDureeFormations;

                    // Requête pour récupérer le total des activités
                    $sqlActivites = "SELECT COUNT(*) AS total_activites FROM autre_activités WHERE id_doctorant = $idDoctorant";
                    $resultActivites = mysqli_query($connexion, $sqlActivites);
                    $rowActivites = mysqli_fetch_assoc($resultActivites);
                    $totalActivites = $rowActivites['total_activites'];
                
                    // Requête pour récupérer le total des communications
                    $sqlCommunications = "SELECT COUNT(*) AS total_communications FROM communication WHERE id_doctorant = $idDoctorant";
                    $resultCommunications = mysqli_query($connexion, $sqlCommunications);
                    $rowCommunications = mysqli_fetch_assoc($resultCommunications);
                    $totalCommunications = $rowCommunications['total_communications'];
                
                    echo '<tr>
                        <td><a href="prof_doctoral.php?id_doctorant=' . $idDoctorant . '">' . $idDoctorant . '</a></td>
                        <td>' . $nomDoctorant . '</td>
                        <td>' . $prenomDoctorant . '</td>
                        <td>' . $etat . '</td>
                        <td>' . $totalArticles . '</td>
                        <td>' . $totalCommunications . '</td>
                        <td>'.$dureeTotale.'</td>
                        <td>' . $totalActivites . '</td>
                        <td><a href="afficher_doctorant.php?id_doctorant=' . $idDoctorant . '">informations</a></td>
                        <td><a href="modifier_doctorant.php?id_doctorant=' . $idDoctorant . '">Modifier</a></td>
                        <td><a href="supprimer_doctoral.php?id_doctorant=' . $idDoctorant . '">Supprimer</a></td>
                    </tr>';
                
                    $counter++;
                }
                
            echo '</table>';
        }
}
?>
        </div>
    </section>
    <!-- membre doctorant End -->
    <!-- Ajouter Projet Start -->
    <div class="title text-center">
            <h1 class="title-blue"><a name="projet">Ajouter Projet</a></h1>
        </div>
        <div class="projet">
    <form action="ajoute_projet.php" method="post" enctype="multipart/form-data">
        <label>Intitule</label>
        <input type="text" placeholder="Intitule" name="intitule">
        <label>Déscription</label>
        <input type="text" placeholder="desc_projet" name="desc_projet"><br>
        <label>Date</label>
        <input type="date" name="durée">
        <label for="nature">Nature :</label>
        <select name="nature" id="nature">
            <option value="">--aucun--</option>
            <option value="pedagogique">Pédagogique</option>
            <option value="scientifique">Scientifique</option>
        </select><br>
        <label>Rapport :</label>
        <input type="file" name="fichier" required><br><br>
    <button type="submit">Envoyer</button>
    </form>
     </div>
    <!-- Ajouter Projet End -->
    <!--thèse soutenue start-->
    <section class="services">
        <div class="container1">
            <div class="title text-center">
                <h1 class="title-blue"><a name="articles" style = "font-size: 50px;">Les Thèses</a></h1>
            </div>
            <div style="display: flex; justify-content: center; align-items: center;">
    <div style="margin-right: 30px;">
            <form method="POST" action="">
                <input type="text" name="annees" id="annees" placeholder="Année (ex: 2023)" required>
                <button type="submit">Rechercher par année</button>
            </form>
        </div>
        <div>
            <form method="POST" action="">
                <input type="text" name="nom_doctorant" id="nom_doctorant" placeholder="Nom du doctorant" required>
                <button type="submit">Rechercher par nom</button>
            </form>
        </div>
    </div> 
        <div class="container">
            <div class="row">
            <?php
            // Vérification de la soumission du formulaire
if (isset($_POST['annees'])) {
    // Récupération des valeurs du formulaire
    $recherche = $_POST['annees'];
// Requête SQL pour récupérer les thèses correspondantes à l'année de soutenance
$idProf = $_SESSION['id'];
$sql = "SELECT t.*, d.nom AS doctorant_nom, d.prenom AS doctorant_prenom
FROM thèses t INNER JOIN doctoral d ON t.id_doctorant = d.id_doctorant
   WHERE t.id_encadrent = $idProf AND YEAR(d.date_soutenance) = '$recherche'";

    $counter = 0;
        $resultatsql = mysqli_query($connexion, $sql);

if ($resultatsql && mysqli_num_rows($resultatsql) > 0) {
    while ($row = mysqli_fetch_assoc($resultatsql)) {
        $idThèse = $row['id_thèse'];
        $nomThèse = $row['thèse'];
        $idDoctorant = $row['id_doctorant'];
        $fichierFileName = $row['fichier'];

        $sqlDoctorant = "SELECT d.nom, d.prenom, p.nom AS nom_professeur, p.prenom AS prenom_professeur
        FROM doctoral d INNER JOIN professeur p ON d.id_encadrent = p.id_encadrent
        WHERE id_doctorant = $idDoctorant";                
        $resultatDoctorant = mysqli_query($connexion, $sqlDoctorant);
        $rowDoctorant = mysqli_fetch_assoc($resultatDoctorant);
        $doctorantNom = $rowDoctorant['nom'];
        $doctorantPrenom = $rowDoctorant['prenom'];
        $encadrentNom = $rowDoctorant['nom_professeur'];
        $encadrentPrenom = $rowDoctorant['prenom_professeur'];

        $sqlJury = "SELECT nom, prenom FROM professeur WHERE id_encadrent IN (SELECT id_encadrent FROM jurys WHERE id_thèse = $idThèse)";
        $resultatJury = mysqli_query($connexion, $sqlJury);
        $counter=0;
        echo '<div class="col-sm-6 col-lg-4">
            <div class="media" data-aos="fade-up" data-aos-delay="' . ($counter * 200) . '" data-aos-duration="' . ($counter * 200 + 200) . '">
                <img class="mr-4" src="assets/images/service5-modified.png" alt="Web Development">
                <div class="media-body">
                    <h5>'.$nomThèse.'</h5>
                    <p>Doctorant: '.$doctorantNom.' '.$doctorantPrenom.'</p>';
                    echo '<p>Encadré par: '.$encadrentNom.' '.$encadrentPrenom.'</p>';

        if ($resultatJury && mysqli_num_rows($resultatJury) > 0) {
            echo '<p>Jury: ';
            while ($rowJury = mysqli_fetch_assoc($resultatJury)) {
                $juryNom = $rowJury['nom'];
                $juryPrenom = $rowJury['prenom'];
                echo $juryNom.' '.$juryPrenom.'<br> ';
                
                $counter++;
            }
            echo '</p>';
        }

        echo '<td><a href="pdf_base/' . $fichierFileName . '">Voir le rapport</a></td>
                </div>
            </div>
        </div>';
        }
    }
        else{
            echo 'Aucune thèse trouvée pour l"année spécifiée.';
        
      }
    }elseif (isset($_POST['nom_doctorant'])) {
        $idProf = $_SESSION['id'];
        $nomDoctorant = $_POST['nom_doctorant'];
    // Récupération des valeurs du formulaire
    $sql = "SELECT t.*, d.nom AS doctorant_nom, d.prenom AS doctorant_prenom
    FROM thèses t INNER JOIN doctoral d ON t.id_doctorant = d.id_doctorant
    WHERE t.id_encadrent = $idProf AND (CONCAT(d.nom, ' ', d.prenom) LIKE '%$nomDoctorant%' OR CONCAT(d.prenom, ' ', d.nom) LIKE '%$nomDoctorant%')";    

    $counter = 0;
        $resultatsql = mysqli_query($connexion, $sql);

if ($resultatsql && mysqli_num_rows($resultatsql) > 0) {
    while ($row = mysqli_fetch_assoc($resultatsql)) {
        $idThèse = $row['id_thèse'];
        $nomThèse = $row['thèse'];
        $idDoctorant = $row['id_doctorant'];
        $fichierFileName = $row['fichier'];
        
        $sqlDoctorant = "SELECT d.nom AS nom_dctorant, d.prenom AS prenom_dctorant, p.nom AS nom_professeur, p.prenom AS prenom_professeur FROM doctoral d JOIN professeur p ON d.id_encadrent = p.id_encadrent WHERE id_doctorant = $idDoctorant";
        $resultatDoctorant = mysqli_query($connexion, $sqlDoctorant);
        $rowDoctorant = mysqli_fetch_assoc($resultatDoctorant);
        $doctorantNom = $rowDoctorant['nom_dctorant'];
        $doctorantPrenom = $rowDoctorant['prenom_dctorant'];
        $encadrentNom = $rowDoctorant['nom_professeur'];
        $encadrentPrenom = $rowDoctorant['prenom_professeur'];

        $sqlJury = "SELECT nom, prenom FROM professeur WHERE id_encadrent IN (SELECT id_encadrent FROM jurys WHERE id_thèse = $idThèse)";
        $resultatJury = mysqli_query($connexion, $sqlJury);
        
        $counter=0;
        echo '<div class="col-sm-6 col-lg-4">
            <div class="media" data-aos="fade-up" data-aos-delay="' . ($counter * 200) . '" data-aos-duration="' . ($counter * 200 + 200) . '">
                <img class="mr-4" src="assets/images/service5-modified.png" alt="Web Development">
                <div class="media-body">
                    <h5>'.$nomThèse.'</h5>
                    <p>Doctorant: '.$doctorantNom.' '.$doctorantPrenom.'
                    <p>Encadré par: '.$encadrentNom.' '.$encadrentPrenom.'</p>';

        if ($resultatJury && mysqli_num_rows($resultatJury) > 0) {
            echo '<p>Jury: ';
            while ($rowJury = mysqli_fetch_assoc($resultatJury)) {
                $juryNom = $rowJury['nom'];
                $juryPrenom = $rowJury['prenom'];
                echo $juryNom.' '.$juryPrenom.'<br> ';
                $counter++;
            }
            echo '</p>';
        }

        echo '<td><a href="pdf_base/' . $fichierFileName . '">Voir le rapport</a></td>
                </div>
            </div>
        </div>';
        }
    }
        else{
            echo 'Aucune thèse trouvée pour le nom spécifiée.';
        
      }
    }else {
        $idProf = $_SESSION['id'];
        $sql = "SELECT * FROM thèses WHERE id_encadrent = $idProf";
        $counter = 0;
        $resultatsql = mysqli_query($connexion, $sql);
    
        if ($resultatsql && mysqli_num_rows($resultatsql) > 0) {
            while ($row = mysqli_fetch_assoc($resultatsql)) {
                $idThèse = $row['id_thèse'];
                $nomThèse = $row['thèse'];
                $idDoctorant = $row['id_doctorant'];
                $fichierFileName = $row['fichier'];
    
                $sqlDoctorant = "SELECT d.nom, d.prenom, p.nom AS nom_professeur, p.prenom AS prenom_professeur
                FROM doctoral d INNER JOIN professeur p ON d.id_encadrent = p.id_encadrent
                WHERE id_doctorant = $idDoctorant";                
                $resultatDoctorant = mysqli_query($connexion, $sqlDoctorant);
                $rowDoctorant = mysqli_fetch_assoc($resultatDoctorant);
                $doctorantNom = $rowDoctorant['nom'];
                $doctorantPrenom = $rowDoctorant['prenom'];
                $encadrentNom = $rowDoctorant['nom_professeur'];
                $encadrentPrenom = $rowDoctorant['prenom_professeur'];
    
                $sqlJury = "SELECT nom, prenom FROM professeur WHERE id_encadrent IN (SELECT id_encadrent FROM jurys WHERE id_thèse = $idThèse)";
                $resultatJury = mysqli_query($connexion, $sqlJury);
                $counter = 0;
    
                echo '<div class="col-sm-6 col-lg-4">
    <div class="media" data-aos="fade-up" data-aos-delay="' . ($counter * 200) . '" data-aos-duration="' . ($counter * 200 + 200) . '">
        <img class="mr-4" src="assets/images/service5-modified.png" alt="Web Development">
        <div class="media-body">
            <h5>'.$nomThèse.'</h5>
            <p>Doctorant: '.$doctorantNom.' '.$doctorantPrenom.'</p>';
            echo '<p>Encadré par: '.$encadrentNom.' '.$encadrentPrenom.'</p>';

                if ($resultatJury && mysqli_num_rows($resultatJury) > 0) {
                    echo '<p>Jury: ';
                    while ($rowJury = mysqli_fetch_assoc($resultatJury)) {
                        $juryNom = $rowJury['nom'];
                        $juryPrenom = $rowJury['prenom'];
                        echo $juryNom.' '.$juryPrenom.', ';
                        $counter++;
                    }
                    echo '</p>';
                }
    
                echo '<td><a href="pdf_base/' . $fichierFileName . '">Voir le rapport</a></td>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo 'Aucune thèse trouvée.';
        }
    }
    
?>

                </div>
            </div>
        </div>
    </section>

    <!--thèse soutenue end-->
    <h1><br><br><br></h1>
   
    <!-- Footer Start -->
    <footer>
        <!-- Widgets Start -->
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget tags-widget" data-aos="fade-up" data-aos-delay="800">
                            <img src="assets/images/fsblogo.png" style="height: 200px; width: 450px;">
                            </div>
                        <div class="single-widget subscribe-widget" data-aos="fade-up" data-aos-delay="800">
                            <form class="" method="get">
                                <div class="input-group">
                                    <input class="field form-control" name="subscribe" type="email"
                                        placeholder="Email Address">
                                    <span class="input-group-btn">
                                        <button type="submit" name="submit-mail"><i class="fa fa-check"></i></button>
                                    </span>
                                </div>
                            </form>
                            <ul class="nav social-nav">
                                <li><a href="https://www.facebook.com/fh5co" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget twitter-widget" data-aos="fade-up" data-aos-delay="200">
                            <div class="media">
                                <div class="media-body ml-3">
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body ml-3">
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body ml-3">
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body ml-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget twitter-widget" data-aos="fade-up" data-aos-delay="200">
                            <div class="media">
                                <div class="media-body ml-3">
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body ml-3">
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body ml-3">
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body ml-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget contact-widget" data-aos="fade-up" data-aos-delay="0">
                            <div class="media">
                                <i class="fa fa-map-marker"></i>
                                <div class="media-body ml-3">
                                    <p>Faculté des Sciences Ben M'Sick, Av Driss El Harti Sidi Othmane Casablanca B.P 7955</p>
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-envelope-o"></i>
                                <div class="media-body ml-3">
                                    <a href="fsbm.contact@univh2c.ma">fsbm.contact@univh2c.ma</a>
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-phone"></i>
                                <div class="media-body ml-3">
                                    <a href="tel:(+212) 6 61 44 24 27">(+212) 6 61 44 24 27</a>
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-phone"></i>
                                <div class="media-body ml-3">
                                    <a href="tel:(+212) 5 22 70 46 71">(+212) 5 22 70 46 71</a>
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-fax"></i>
                                <div class="media-body ml-3">
                                    <a href="fax:(+212) 5 22 70 46 75">(+212) 5 22 70 46 75</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <!-- Foot Note End -->
    </footer>
    <!-- Footer Endt -->
    <!--jQuery-->
    <script src="assets/js/jquery-3.3.1.js"></script>
    <!--Plugins-->
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/loaders.css.js"></script>
    <script src="assets/js/aos.js"></script>
    <script src="assets/js/swiper.min.js"></script>
    <script src="assets/js/lightgallery-all.min.js"></script>
    <!--Template Script-->
    <script src="assets/js/main.js"></script>
    
</body>

</html>
<?php
mysqli_close($connexion);

?>