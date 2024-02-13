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
                        <?php
                                    $sql = 'SELECT équipe FROM équipes WHERE id_labos=321';
                                    $resultatsql = mysqli_query($connexion,$sql);
                                    while($row = mysqli_fetch_assoc($resultatsql)){
                                        $Equipe = $row['équipe'];
                                    echo '
                            <div class="swiper-slide slide-content d-flex align-items-center">
                                <div class="single-slide">
                                   <h1 data-aos="fade-right" data-aos-delay="200" style="margin-top:-15%">'.$Equipe.'</h1>
                                </div>
                            </div>
                            ';
                                  }
                                    ?>
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
    <h1><br><br></h1>
    <!-- Membres Start -->
    <section class="testimonial-and-clients" style="background-color:#fff;">
        <div class="container">
            <div class="testimonials">
                <div class="swiper-container test-slider">
                    <div class="swiper-wrapper">
                    <?php 
                    $sql = "SELECT e.*, p.imags FROM équipes e INNER JOIN professeur p ON e.id_équipe = p.id_équipe INNER JOIN roles r ON p.id_encadrent = r.id_encadrent
                    WHERE r.role = 'Responsable' AND e.id_labos = 321";
            $resultatsql = mysqli_query($connexion, $sql);
            
            // Boucle pour afficher les équipes
            while ($row = mysqli_fetch_assoc($resultatsql)) {
                $Equipe = $row['équipe'];
                $id_Equipe = $row['id_équipe'];
                $Image = $row['imags'];
            
                echo '
                <div class="swiper-slide text-center">
                    <div class="row">
                        <div class="offset-lg-1 col-lg-10">
                            <div class="test-img" data-aos="fade-up" data-aos-delay="0" data-aos-offset="0">';
                if (isset($Image) && $Image !== null) {
                    echo '<img class="mr-4" src="data:image/jpeg;base64,' . base64_encode($Image) . '" alt=" ">';
                }
                echo '</div>
                            <h5 data-aos="fade-up" data-aos-delay="200" data-aos-duration="600" data-aos-offset="0">Axes de recherche de l’équipe:<br>' . $Equipe . '</h5>';
            
                            $sqlAxe = "SELECT nom_axe FROM axes WHERE id_équipe = '$id_Equipe'";
                $resultatAxe = mysqli_query($connexion, $sqlAxe);
            
                // Boucle pour afficher les axes
                while ($rowAxe = mysqli_fetch_assoc($resultatAxe)) {
                    $Axe = $rowAxe['nom_axe'];
                    echo '<p data-aos="fade-up" data-aos-delay="600" data-aos-duration="600" data-aos-offset="0">' . $Axe . '</p>';
                }
                echo '
                                </div>
                            </div>
                        </div>';
                    }
                    echo '</div>
                    <div class="test-pagination"></div>
                    </div>
                    </div>
                    <div class="clients" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                <div class="swiper-container clients-slider">
                <div class="swiper-wrapper">';
                $membre = "SELECT imags FROM professeur WHERE id_labos = 321";
$resultatMembre = mysqli_query($connexion, $membre);

while ($rowProf = mysqli_fetch_assoc($resultatMembre)) {
    $Image = $rowProf['imags'];

    // Vérifier si l'image existe dans le dossier "base_image"
    $imagePath = 'image_base/' . $Image;
    if (file_exists($imagePath)) {
        // Afficher l'image à partir du dossier "base_image"
        echo '<div class="swiper-slide">
                <img src="' . $imagePath . '" alt="Image" style="width: 100px; height: 120px;">
            </div>';
    } else {
        echo '<div class="swiper-slide">
                <img src="data:image/jpeg;base64,' . base64_encode($Image) . '" alt="Image" style="width: 100px; height: 120px;">
            </div>';
    }
}
            echo'</div>';

                    echo '</div>
                    <div class="test-pagination"></div>
                    
                    </div>
                    </div>
                    </div>
                    </section>';
?>

    <!-- Membres END -->
    <!--équipe Start-->
    <?php
    $sql = "SELECT * FROM équipes WHERE id_labos = 321";
    $resultatsql = mysqli_query($connexion,$sql);

    while($rowEquipe = mysqli_fetch_assoc($resultatsql)){
        $Equipe = $rowEquipe['équipe'];
        $id_Equipe = $rowEquipe['id_équipe'];
        echo'<section class="cta" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="cta-content d-xl-flex align-items-center justify-content-around text-center text-xl-left">
                <div class="content" data-aos="fade-right" data-aos-delay="200">
                    <h2> <a name="'.$Equipe.'">'.$Equipe.'</a></h2>
                </div>
            </div>
        </div>
    </section><h1><br><br><br><br></h1>';
    $sqlRespo = "SELECT p.*, r.role, r.description FROM professeur p INNER JOIN roles r ON p.id_encadrent = r.id_encadrent WHERE p.id_équipe = $id_Equipe AND r.role = 'Responsable'";
    $resultatRespo = mysqli_query($connexion,$sqlRespo);

    if ($rowRespo = mysqli_fetch_assoc($resultatRespo)) {
    $Nom = $rowRespo['nom'];
    $Prenom = $rowRespo['prenom'];
    $Login = $rowRespo['login'];
    $Description = $rowRespo['description'];
    echo'<section class="featured">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="400" data-aos-duration="800">
                    <div class="title">
                        <h2 class="title-blue">responssable: Pr.'.$Nom.''.$Prenom.'  </h2>
                    </div>
                    <p>'.$Description.' </p>
                        <div class="container">
                            <div class="top-header d-none d-sm-flex justify-content-between align-items-center">
                                <div class="contact">
                                    <a href="mailto:info@yourmail.com" style="color: #26264b;"><i class="fa fa-envelope"
                                            aria-hidden="true" style="color: #afe7d3;"></i>'.$Login.'</a>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="400" data-aos-duration="800">
                    <div class="featured-img">';
                    $Image = $rowRespo['imags'];

    // Vérifier si l'image existe dans le dossier "base_image"
    $imagePath = 'image_base/' . $Image;
    if (file_exists($imagePath)) {
        // Afficher l'image à partir du dossier "base_image"
        echo '<div class="swiper-slide">
                <img class="featured-big" src="' . $imagePath . '" alt="Featured 1" style="width: 322px; height: 300px;margin-bottom: -200px; ">
                <img class="featured-small" src="' . $imagePath . '" alt="Featured 2"style="margin-bottom: -200px;" >
            </div>';
    } else {
        echo '<div class="swiper-slide">
                <img class="featured-big" src="data:image/jpeg;base64,' . base64_encode($Image) . '" alt="Featured 1" style="width: 400px; height: 450px;margin-bottom: -140px;">
                <img class="featured-small" src="data:image/jpeg;base64,' . base64_encode($Image) . '" alt="Featured 2" style="width: 200px; height: 200px; margin-bottom: -140px;" >
            </div>';
    }
                    echo'</div>
                </div>
            </div>
        </div>
    </section><h1><br><br></h1>';}
    echo'<section class="services">
    <div class="container">
        <div class="title text-center">
            
            <h1 class="title-blue">Membre D’équipe</h1>
        </div>
        <div class="container">
            <div class="row">';
            $sqlMembre = "SELECT p.*, r.role FROM professeur p INNER JOIN roles r ON p.id_encadrent = r.id_encadrent WHERE id_équipe = $id_Equipe AND r.role <> 'Responsable'";
            $resultatmbres = mysqli_query($connexion,$sqlMembre);
            while($rowMembre = mysqli_fetch_assoc($resultatmbres)){
                $NomProf = $rowMembre['nom'];
                $PrenomProf = $rowMembre['prenom'];
                echo'<div class="col-sm-6 col-lg-4">
                    <div class="media" data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">';
                    $Image = $rowMembre['imags'];

                    // Vérifier si l'image existe dans le dossier "base_image"
                    $imagePath = 'image_base/' . $Image;
                    if (file_exists($imagePath)) {
                   // Afficher l'image à partir du dossier "base_image"
                   echo '<img class="mr-4" src="' . $imagePath . '" alt="Web Development">
                   <div class="media-body">';
                } else {
                    echo '
                    <img class="mr-4" src="data:image/jpeg;base64,' . base64_encode($Image) . '" alt="Image">
                    <div class="media-body">';
                }
                        
                echo'<h5>Pr. '.$NomProf.' '.$PrenomProf.'</h5>
                        </div>
                    </div>
                </div>';
            }
                echo'</div>
            </div>
        </div>
    </section>';
    $sqlAxes = "SELECT nom_axe FROM axes WHERE id_équipe=$id_Equipe";
    $resultatAxes = mysqli_query($connexion,$sqlAxes);
    echo'<section class="trust">
    <div class="container">
        <div class="row">
            <div class="offset-xl-1 col-xl-6" data-aos="fade-right" data-aos-delay="200" data-aos-duration="800">
                    <div class="title">
                        <h2>Les Axes de recherche de l’équipe</h2>
                    </div>
                    <ul class="list-unstyled">';
                    while($rowAxes = mysqli_fetch_assoc($resultatAxes)){
                        $axes = $rowAxes['nom_axe'];
                    echo'
                        <li>'.$axes.'</li>';}
                        echo'</ul>
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
    </section><h1><br><br><br></h1>';
    }
    ?>
    <!--équipe End-->

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