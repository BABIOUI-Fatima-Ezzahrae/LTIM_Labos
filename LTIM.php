<?php
include 'connexion.php';
?>

<!doctype html>
<html lang="en">

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
        .testimonial-and-clients {
            background: url(../images/test-clients-bg.png) center center/cover no-repeat #afe3d7;
        }
        .img-fluid {
            width: 300px;
            height: 170px;
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
                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent" style="padding-right: 200px;">
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
                                <h1 data-aos="fade-right" data-aos-delay="200" style="margin-top:-15%"> Laboratoire de Technologie de l’Information et Modélisation (LTIM)</h1>                                    </h1>
                                </div>
                            </div>
                            <div class="swiper-slide slide-content d-flex align-items-center" style="margin-top:-10%">
                                <div class="single-slide">
                                    <p data-aos="fade-right" data-aos-delay="600">Le Laboratoire de Technologie de l'Information et Modélisation (LTIM) de la Faculté des Sciences Ben M'sik (FSBM) est un <br>laboratoire de recherche qui se concentre sur les technologies de l'information et de la communication (TIC) et leur application <br>dans différents domaines. La FSBM est une des facultés de l'Université Hassan II de Casablanca, au Maroc.
                                        Les activités de recherche du LTIM couvrent un large éventail de domaines, tels que l'ingénierie logicielle, les réseaux de communication, la sécurité informatique, les systèmes d'information, l'intelligence artificielle, la vision par ordinateur, la modélisation et la simulation des systèmes complexes, et bien d'autres encore.
                                        Le LTIM travaille en étroite collaboration avec d'autres institutions de recherche au Maroc et à l'étranger, ainsi qu'avec des entreprises et des industries. Les chercheurs du LTIM sont impliqués dans des projets de recherche nationaux et internationaux, ainsi que dans des collaborations industrielles.
                                        Le LTIM propose également des formations en technologies de l'information et de la communication, ainsi que des stages de recherche pour les étudiants de master et de doctorat.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Add Control -->
            <span class="arr-left"><i class="fa fa-angle-left"></i></span>
            <span class="arr-right"><i class="fa fa-angle-right"></i></span>
        </div>
    </section>
    <!-- Hero End -->
    <!-- Call To Action Start -->
    <section class="cta" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="cta-content d-xl-flex align-items-center justify-content-around text-center text-xl-left">
                <div class="content" data-aos="fade-right" data-aos-delay="200">
                <?php
                    $sql = "SELECT p.*, r.role FROM professeur p INNER JOIN roles r ON p.id_encadrent = r.id_encadrent WHERE r.role = 'Directeur' AND p.id_labos = 321";
                    $resultatsql = mysqli_query($connexion, $sql);
                    if (mysqli_num_rows($resultatsql) > 0) {
                        $row = mysqli_fetch_assoc($resultatsql);
                    
                        // Récupérer les informations du professeur
                        $nomProfesseur = $row['nom'];
                        $prenomProfesseur = $row['prenom'];
                        $loginProfesseur = $row['login'];
                        $imagsProfesseur = $row['imags'];
                        echo "<h2>Directeur de Laboratoire de Recherche LTIM</h2>
                        <h4>Pr. $nomProfesseur $prenomProfesseur</h4>";
                        echo "<a href='$loginProfesseur' style='color: #afe3d7;'>$loginProfesseur</a>
                        <p>Professor of computer Science at Faculty of Science Ben M'sik Casablanca</p>";
                    }
                
                    ?>
                </div>
                <div class="subscribe-btn" data-aos="fade-left" data-aos-delay="400" data-aos-offset="0">
                <?php
                $sql = "SELECT p.*, r.role FROM professeur p INNER JOIN roles r ON p.id_encadrent = r.id_encadrent WHERE r.role = 'Directeur' AND p.id_labos = 321";
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
                        $sql = "SELECT p.*, r.role FROM professeur p INNER JOIN roles r ON p.id_encadrent = r.id_encadrent WHERE r.role = 'Directeur' AND p.id_labos = 321";
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

    <!-- Liste d'équipes Start -->
    <section class="recent-posts">
        <div class="container">
            <div class="row">
            <?php
$sqlEquipe = "SELECT équipe, image, count(*) AS total FROM équipes WHERE id_labos = 321 GROUP BY équipe, image";
$resultatEquipe = mysqli_query($connexion, $sqlEquipe);

// Stocker toutes les équipes et les images dans un tableau
$equipes = array();
while ($rowEquipe = mysqli_fetch_assoc($resultatEquipe)) {
    $equipes[] = $rowEquipe;
}

$totalEquipes = count($equipes);

if ($totalEquipes % 2 == 1) {
    for ($i = 0; $i < $totalEquipes - 1; $i++) {
        $Equipe = $equipes[$i]['équipe'];
        $Image = $equipes[$i]['image'];

        if ($i % 2 == 0) {
            echo '
                <div class="col-lg-6">
                    <div class="single-rpost d-sm-flex align-items-center" data-aos="fade-right" data-aos-duration="800">
                        <div class="post-content text-sm-right">
                            <h3><a href="équipe_LTIM.php#BDIGSI">'.$Equipe.'</a></h3>
                        </div>
                        <div class="post-thumb">';
            if (isset($Image) && $Image !== null) {
                echo '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($Image) . '" alt="Post '.$i.'">';
            }
            echo '</div>
                    </div>
                </div>';
        } else {
            echo '
                <div class="col-lg-6">
                    <div class="single-rpost d-sm-flex align-items-center" data-aos="fade-right" data-aos-duration="800">
                        <div class="post-thumb">';
            if (isset($Image) && $Image !== null) {
                echo '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($Image) . '" alt="Post '.$i.'">';
            }
            echo '</div>
                        <div class="post-content text-sm-right">
                            <h3><a href="équipe_LTIM.php#'.$Equipe.'">'.$Equipe.'</a></h3>
                        </div>
                    </div>
                </div>';
        }
    }

    // Dernière équipe pour un nombre impair d'équipes
    $lastEquipe = $equipes[$totalEquipes - 1]['équipe'];
    $lastImage = $equipes[$totalEquipes - 1]['image'];
        echo '
            <div class="col-lg-6" style="margin-left : 35%">
                    <div class="single-rpost d-sm-flex align-items-center" data-aos="fade-right" data-aos-duration="800">
                    <div class="post-thumb">';
        if (isset($Image) && $Image !== null) {
            echo '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($Image) . '" alt="Post '.$i.'">';
        }
        echo '</div>
                </div>
                <div class="single-rpost d-sm-flex align-items-center" data-aos="fade-right" data-aos-duration="800">
                    <div class="post-content text-sm-right">
                        <h3><a href="équipe_LTIM.php#'.$Equipe.'">'.$Equipe.'</a></h3>
                    </div>                
                    </div>
            </div>';
} else {
    foreach ($equipes as $index => $equipe) {
        $Equipe = $equipe['équipe'];
        $Image = $equipe['image'];

        if ($index % 2 == 0) {
            echo '
                <div class="col-lg-6">
                    <div class="single-rpost d-sm-flex align-items-center" data-aos="fade-right" data-aos-duration="800">
                        <div class="post-content text-sm-right">
                            <h3><a href="équipe_LTIM.php#'.$Equipe.'">'.$Equipe.'</a></h3>
                        </div>
                        <div class="post-thumb">';
            if (isset($Image) && $Image !== null) {
                echo '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($Image) . '" alt="Post '.$index.'">';
            }
            echo '</div>
                    </div>
                </div>';
        } else {
            echo '
                <div class="col-lg-6">
                    <div class="single-rpost d-sm-flex align-items-center" data-aos="fade-right" data-aos-duration="800">
                        <div class="post-thumb">';
            if (isset($Image) && $Image !== null) {
                echo '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($Image) . '" alt="Post '.$index.'">';
            }
            echo '</div>
                        <div class="post-content text-sm-right">
                            <h3><a href="équipe_LTIM.php#'.$Equipe.'">'.$Equipe.'</a></h3>
                        </div>
                    </div>
                </div>';
        }
    }
}

?>
            </div>
            <div class="text-center">
                <a href="équipe_LTIM.php" class="btn btn-primary">équipe_Recherche</a>
            </div>
        </div>
    </section>
    <!-- Liste d'équipes End -->
    
    <!-- Thèmes Start -->
    <section class="trust">
        <div class="container">
            <div class="row">
                <div class="offset-xl-1 col-xl-6" data-aos="fade-right" data-aos-delay="200" data-aos-duration="800">
                    <div class="title">
                        <h6 class="title-primary">about LTIM</h6>
                        <h1>Thèmes fédérateurs du laboratoire</h1>
                    </div>
                    <ul>
                        <?php
                        $sql = "SELECT nom_theme FROM themes WHERE id_labos= 321";
                        $resultatsql = mysqli_query($connexion,$sql);
                        while ($row = mysqli_fetch_assoc($resultatsql)){
                            $Theme = $row['nom_theme'];
                        echo '<li>'.$Theme.'</li>';
                    }
                    ?>
                    </ul>
                </div>
                <div class="col-xl-5 gallery">
                    <div class="row no-gutters h-100" id="lightgallery">
                        <a href="https://lorempixel.com/600/400/" class="w-50 h-100 gal-img" data-aos="fade-up"
                            data-aos-delay="200" data-aos-duration="400">
                            <img class="img-fluid" src="assets/images/gallery1.jpg" alt="Gallery Image">
                            <i class="fa fa-caret-right"></i>
                        </a>
                        <a href="https://lorempixel.com/600/400/" class="w-50 h-50 gal-img" data-aos="fade-up"
                            data-aos-delay="400" data-aos-duration="600">
                            <img class="img-fluid" src="assets/images/gallery2.jpg" alt="Gallery Image">
                            <i class="fa fa-caret-right"></i>
                        </a>
                        <a href="https://lorempixel.com/600/400/" class="w-50 h-50 gal-img gal-img3" data-aos="fade-up"
                            data-aos-delay="0" data-aos-duration="600">
                            <img class="img-fluid" src="assets/images/gallery3.jpg" alt="Gallery Image">
                            <i class="fa fa-caret-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Thèmes End -->    
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
                    <!--///-->
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
        
    </footer>
    <!-- Footer End -->
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