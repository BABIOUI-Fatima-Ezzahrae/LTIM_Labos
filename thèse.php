<?php
include 'connexion.php';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>LTIM</title>
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
.services a{
    color:  rgba(24, 9, 53);
    font-size: 16px;
}
.services a:hover{
    color: #fff;
    font-size: 16px;
    text-decoration: none;
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
    .form-container {
        background-color: #afe3d7;
        border: 1px solid #ccc;
        border-radius: 15px;
        padding: 25px;
        margin: 0 auto;
        max-width: 70%;
    }

    .form-container h2 {
        margin-top: 0;
    }

    .form-container label {
        display: block;
        margin-bottom: 10px;
    }

    .form-container input[type="text"],
    .form-container input[type="date"],
    .form-container input[type="file"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        color: #000;
    }

    .form-container input[type="submit"] {
        background-color: rgba(24, 9, 53, 0.77);
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 30%;
        margin-left: 35%;
    }

    .form-container input[type="submit"]:hover {
        background-color: #fefefe;
        color: rgba(24, 9, 53)
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
                <?php 
                 session_start();
                if (isset($_SESSION['id'])) {
                    include 'menu.php';
                } else {
                    // L'utilisateur n'est pas connecté
                    echo '
                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent" style="margin-left: -27%;">
                            <ul class="navbar-nav">
                                <li class="nav-item" name="menu"><a class="nav-link" href="ltim.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="équipe.php">équipe LTIM</a></li>
                                <li class="nav-item"><a class="nav-link" href="activités.php">Activités</a></li>
                                <li class="nav-item"><a class="nav-link" href="thèse.php">Thèses</a></li>
                                <li class="nav-item"><a class="nav-link" href="login.php">Connecter</a></li>
                            </ul>
                        </div>
                    ';
                }                
                ?>
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
    
    <!--thèse soutenue start-->
    <section class="services">
        <div class="container">
            <div class="title text-center">
                <h1 class="title-blue"><a name="articles" style="font-size: 50px;">******Thèses******</a></h1>
            </div>
            <div style="display: flex; justify-content: center; align-items: center;">
            <div style="margin-right: 30px;">
            <form method="POST" action="">
                <input type="text" name="annee" id="annee" placeholder="Année (ex: 2023)" required>
                <button type="submit">Rechercher par année</button>
            </form>
        </div>
        <div style="margin-right: 30px;">
            <form method="POST" action="">
                <input type="text" name="nom_professeur" id="nom_professeur" placeholder="Nom du professeur" required>
                <button type="submit">Rechercher par nom</button>
            </form>
        </div>
        <div>
        <?php 
        
        // Requête SQL pour compter le nombre de thèse
        $sql = "SELECT COUNT(*) AS total
        FROM thèses t
        JOIN doctoral d ON t.id_doctorant = d.id_doctorant";
        // Exécution de la requête
        $result = $connexion->query($sql);
        // Vérification des résultats
        if ($result && $result->num_rows > 0) {
        // Récupération du nombre total_thèses
        $row = $result->fetch_assoc();
        $totalthèses = $row["total"];

        // Affichage du nombre des thèses
            echo '<h5>Nombre de thèses :</h5><p style="color: black; font-size: 16px; font-weight: bold;">' . $totalthèses . '</p>';
        }
    ?>
    </div>
    </div> 
        <div class="container">
            <div class="row">
            <?php
            // Vérification de la soumission du formulaire
if (isset($_POST['annee'])) {
    // Récupération des valeurs du formulaire
    $recherche = $_POST['annee'];
// Requête SQL pour récupérer les thèses correspondantes à l'année de soutenance
$sql = "SELECT t.*, d.nom AS doctorant_nom, d.prenom AS doctorant_prenom
FROM thèses t INNER JOIN doctoral d ON t.id_doctorant = d.id_doctorant
   WHERE YEAR(d.date_soutenance) = '$recherche'";

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
    }elseif (isset($_POST['nom_professeur'])) {

        $nomProfesseur = $_POST['nom_professeur'];
    // Récupération des valeurs du formulaire
    $sql = "SELECT t.*, p.nom AS professeur_nom, p.prenom AS professeur_prenom
    FROM thèses t INNER JOIN professeur p ON t.id_encadrent = p.id_encadrent
    WHERE CONCAT(p.nom, ' ', p.prenom) LIKE '%$nomProfesseur%' OR CONCAT(p.prenom, ' ', p.nom) LIKE '%$nomProfesseur%'";    

    $counter = 0;
        $resultatsql = mysqli_query($connexion, $sql);

if ($resultatsql && mysqli_num_rows($resultatsql) > 0) {
    while ($row = mysqli_fetch_assoc($resultatsql)) {
        $idThèse = $row['id_thèse'];
        $nomThèse = $row['thèse'];
        $idDoctorant = $row['id_doctorant'];
        $fichierFileName = $row['fichier'];
        $encadrentNom = $row['professeur_nom'];
        $encadrentPrenom = $row['professeur_prenom'];
        

        $sqlDoctorant = "SELECT nom, prenom FROM doctoral WHERE id_doctorant = $idDoctorant";
        $resultatDoctorant = mysqli_query($connexion, $sqlDoctorant);
        $rowDoctorant = mysqli_fetch_assoc($resultatDoctorant);
        $doctorantNom = $rowDoctorant['nom'];
        $doctorantPrenom = $rowDoctorant['prenom'];

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
        $sql = "SELECT * FROM thèses";
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

    <!--thèse soutenue start-->

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