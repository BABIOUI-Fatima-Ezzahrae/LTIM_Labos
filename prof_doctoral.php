<?php
include 'connexion.php';
session_start ();
$idprof = $_SESSION['id'];
$nomprof = $_SESSION['nom'];
$prenomprof = $_SESSION['prenom'];
$sql = "SELECT * FROM doctoral WHERE id_encadrent = $idprof";
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
        .table-container {
            max-width: 800px;
            overflow-x: auto;
        }

.table-container table {
  width: 100%; 
  border-collapse: collapse;
  color: #fff;
}
th {
    font-size: 24px;
    color: #fff;
}
.table-container th, .table-container td {
  padding: 8px;
  text-align: center;
  white-space: nowrap;

}

.empty-message {
  text-align: center;
  margin: 16px 0;
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
                        echo "<h4>Pr. $nomProfesseur $prenomProfesseur</h4>";
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
    <br><br><br>
    
    <!-- Services Start -->
    <section class="services">
    <div class="container">
        <div class="title text-center">
            <h1 class="title-blue"><a name="article">******Articles******</a></h1>
        </div>
        <div class="container">
            <div class="row">
            <?php
                $idDoctorant = $_GET['id_doctorant'];
                $sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";
                $resultatsql = mysqli_query($connexion, $sql);
                if (mysqli_num_rows($resultatsql) > 0) {
                    $row = mysqli_fetch_assoc($resultatsql);
                    $idDoctorant = $row['id_doctorant'];
                    $sqlArticle = "SELECT * FROM article_doctorant WHERE id_doctorant = $idDoctorant";
                    $resultatArticle = mysqli_query($connexion, $sqlArticle);
                    if (mysqli_num_rows($resultatArticle) > 0) {
                        $counter = 1;
                        while ($rowArticle = mysqli_fetch_assoc($resultatArticle)) {
                            $nomArticle = $rowArticle['nom_article'];
                            $Rapport = $rowArticle['fichier'];
                            echo '<div class="col-sm-6 col-lg-4">
                            <div class="media" data-aos="fade-up" data-aos-delay="' . ($counter * 200) . '" data-aos-duration="' . ($counter * 200 + 200) . '">
                             <img class="mr-4" src="assets/images/service5-modified.png" alt="Web Development">
                             <div class="media-body">
                                <h5>'.$nomArticle.'</h5>
                                <a href="pdf_base/' . $Rapport . '">détails...</a>
                                </div>
                              </div>
                            </div>';
                            $counter++;
                        }
                    }
                }
                ?>
            </div>
        </div>
        <!--<a data-aos="fade-right" data-aos-delay="900" href="#" class="btn btn-primary"><- Précédant</a>
        <a data-aos="fade-right" data-aos-delay="900" href="#" class="btn btn-primary">suivant -></a>-->
    </div>
</section>
    <!-- Services End -->
    <h1><br><br><br></h1>
     <h1><br><br><br></h1>
    <!-- Communication Start -->
    <section class="featured">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="400" data-aos-duration="800">
                    <div class="title">
                        <h1 class="title-blue"><a name="commun">Communication</a></h1>
                    </div>
                        <div class="container">
                            <div class="top-header d-none d-sm-flex justify-content-between align-items-center">
                                <div class="contact">
                                <?php
                                $idProfesseur = $_SESSION['id'];
                                // Récupération de l'ID du professeur connecté
                           
                                $idDoctorant = $_GET['id_doctorant']; // Récupération de l'ID du doctorant spécifié dans le paramètre GET
                           
                                $sqlCommunication = "SELECT * FROM communication WHERE id_doctorant = $idDoctorant"; 
                                $resultatCommunication = mysqli_query($connexion, $sqlCommunication);
                            
                                if (mysqli_num_rows($resultatCommunication) > 0) {
                                    echo '<div class="table-container">
                                    <table>
                                        <tr>
                                            <th>Intitule </th>
                                            <th>Date</th>
                                            <th>Temp</th>
                                            <th>Justification</th>
                                        </tr>';
                            
                                while ($rowCommunication = mysqli_fetch_assoc($resultatCommunication)) {
                                    $idCommunication = $rowCommunication['id_communic	'];
                                    $nomCommunication = $rowCommunication['nom_commun'];
                                    $dateCommunication = $rowCommunication['date'];
                                    $tempCommunication = $rowFormation['nature'];
                                    $Rapport = $rowCommunication['fichier'];
                            
                                    echo '<tr>
                                            <td>'.$nomFormation.'</td>
                                            <td>'.$dateFormation.'</td>
                                            <td>'.nl2br($tempFormation).'</td>
                                            <td>';
                            
                                    echo '<a href="pdf_base/' . $Rapport . '">détails...</a>';
                            
                                    echo '</td></tr>';
                                }
                            
                                echo '</table></div>';
                            }                            
                            ?>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="400" data-aos-duration="800">
                    <div class="featured-img">
                        <img class="featured-big" src="assets/images/img_formation.jpg" style="width: 422px; height: 360px;" alt="Featured 1">
                        <img class="featured-small" src="assets/images/img_formation.jpg" style="width: 242px; height: 231px;" alt="Featured 2">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Communication End -->

    <!-- Featured Start -->
    <section class="featured" style="background-color: #170936;">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="400" data-aos-duration="800">
                    <div class="title text-center">
                        <h1 class="title-primary"style="font-size:30px;"><a name="formation">Formation Transversale</a></h1>
                    </div>
                    <div class="media-element d-flex justify-content-between">
                        <div class="media">
                            <i class="fa fa-magic mr-4"></i>
                            <div class="media-body">
                            <?php
                            $idProfesseur = $_SESSION['id']; 
                            // Récupération de l'ID du professeur connecté
                            
                            $idDoctorant = $_GET['id_doctorant']; // Récupération de l'ID du doctorant spécifié dans le paramètre GET
                            
                            $sqlFormations = "SELECT * FROM formations WHERE id_doctorant = $idDoctorant"; 
                            $resultatFormations = mysqli_query($connexion, $sqlFormations);
                            
                            if (mysqli_num_rows($resultatFormations) > 0) {
                                echo '<div class="table-container">
                                    <table>
                                        <tr>
                                            <th>          Intitule           </th>
                                            <th>Date</th>
                                            <th>Temp</th>
                                            <th>Justification</th>
                                        </tr>';
                            
                                while ($rowFormation = mysqli_fetch_assoc($resultatFormations)) {
                                    $idFormation = $rowFormation['id_formation'];
                                    $nomFormation = $rowFormation['nom_formation'];
                                    $dateFormation = $rowFormation['date'];
                                    $tempFormation = $rowFormation['temp'];
                                    $Rapport = $rowFormation['fichier'];
                            
                                    echo '<tr>
                                            <td>'.$nomFormation.'</td>
                                            <td>'.$dateFormation.'</td>
                                            <td>'.nl2br($tempFormation).'</td>
                                            <td>';
                                            
                                    echo '<a href="pdf_base/' . $Rapport . '">détails...</a>';
                            
                                    echo '</td></tr>';
                                }
                            
                                echo '</table></div>';
                            }                            
                            ?>

                            </div>
                        </div> 
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="400" data-aos-duration="800" style="margin-left: 170%; margin-top: 10%;">
                    <div class="featured-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured End -->
    <br><br><br><br>
    <section class="featured">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="400" data-aos-duration="800" style="margin-bottom: -10%; margin-left:-5%;">
                    <div class="featured-img">
                        <img class="featured-big" src="assets/images/img_formation.jpg" style="width: 422px; height: 360px;" alt="Featured 1">
                        <img class="featured-small" src="assets/images/img_formation.jpg" style="width: 242px; height: 231px;" alt="Featured 2">
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="400" data-aos-duration="800">
                    <h1><br><br><br><br></h1>
                    <div class="title">
                        <h2 class="title-blue" style="color: #afe3d7;"><a name="autre">Autre Activité</a></h2>
                    <div class="media-element d-flex justify-content-between">
                        <div class="media">
                            <i class="fa fa-magic mr-4"></i>
                            <div class="media-body">
                                <?php
                            $idProfesseur = $_SESSION['id']; 
                            // Récupération de l'ID du professeur connecté
                            
                            $idDoctorant = $_GET['id_doctorant']; // Récupération de l'ID du doctorant spécifié dans le paramètre GET
                            
                            $sqlActivites = "SELECT * FROM autre_activités WHERE id_doctorant = $idDoctorant"; 
                            $resultatAutresActivites = mysqli_query($connexion, $sqlActivites);
                            
                            if (mysqli_num_rows($resultatAutresActivites) > 0) {
                                echo '<div class="table-container">
                                    <table style="background-color: #afe3d7;">
                                        <tr style="background-color: #170936;">
                                            <th>    Intitule      </th>
                                            <th>Date</th>
                                            <th>Justification</th>
                                        </tr>';
                            
                                        while ($rowActivite = mysqli_fetch_assoc($resultatAutresActivites)) {
                                            $idActivite = $rowActivite['id_autre'];
                                            $dateActivite = $rowActivite['date'];
                                            $nomActivite = $rowActivite['nom'];
                                            $Rapport = $rowActivite['fichier'];
                            
                                            echo '<tr>
                                                    <td>'.$nomActivite.'</td>
                                                    <td>'.$dateActivite.'</td>
                                                    <td>';
                            
                                            echo '<a href="pdf_base/' . $Rapport . '">détails...</a>';
                            
                                            echo '</td></tr>';
                                        }
                            
                                        echo '</table></div>';
                                    }                           
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <h1><br><br><br><br></h1>
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