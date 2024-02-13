<?php
include 'connexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Activité LTIM</title>
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
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <title>Image Slider</title>
    <style type="text/css">
        .Formation-Activité {
            width: 80%;
            border-left: 4px solid #444242;
            margin-top: -1%;
            box-shadow: 0 10px 18px -5px black;
            border-right: 4px solid #444242;
            border-bottom: 4px solid #444242;
            padding-left: 2%;
            height: 100vh;
            overflow-y: scroll;
            margin-left: 10%;
            margin-right: 10%;
        }
        .formations_activités {
            border: 1px solid #a5a3a3;
            box-shadow: 12px 0 15px -4px #a5a3a3, -12px 0 8px -4px #a5a3a3;
            padding-bottom: 4%;
            margin-left: 3%;
            margin-right: 3%;
        }
        a {
            color: #170936;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
            text-decoration: none;
        }
        .swiper-container {
            width: 100%;
            height: 30em;
        }
        .swiper-slide{
            margin-top: 4%;
        }
        .swiper-slide img {
            margin-top: 0.1%;
            width: 100%;
            height: 90%;
            object-fit: cover;
        }
    </style>
</head>
<body>
 <!-- Header Start -->
 <header class="position-absolute w-100" style="  margin-top: -1.1%;">
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
    <!-- Activités Start -->
<div class="swiper-container" style="height:500px; z-index: 0; margin-top: 1%;">
    <div class="swiper-wrapper">
    <?php
        $sql_Activité = "SELECT * FROM activité_labos ORDER BY date_creation DESC LIMIT 4";
        $resultat_Activité = mysqli_query($connexion, $sql_Activité);

        while ($rowActivité = mysqli_fetch_assoc($resultat_Activité)) {
            $imageFileName = $rowActivité['image_activité'];
            $imagePath = 'image_base/' . $imageFileName;
            $fichierFileName = $rowActivité['fichier'];
            $fichierPath = 'pdf_base/' . $fichierFileName;

            // Vérifier si le fichier image existe
            if (file_exists($imagePath)) {
                // Lire les données binaires de l'image
                $imageData = file_get_contents($imagePath);

                // Encoder les données en base64
                $imageBase64 = base64_encode($imageData);
        echo'<div class="swiper-slide">
            <a href="details_fichier.php?file='.base64_encode($fichierFileName).'" target="_blank">
            <img src="data:image/jpeg;base64,' . $imageBase64 . '" alt="Image" style="height: 520px; width:100%; margin-top:12px;">
            </a>
        </div>';
    }else {
        echo'<div class="swiper-slide">
        <a href="details_fichier.php?file='.base64_encode($fichierFileName).'" target="_blank">
        <img src="data:image/jpeg;base64,' . base64_encode($rowActivité['image_activité']) . '" alt="Image">
        </a>
        </div>';
    }
            }
            ?>
    </div>
    <div class="swiper-pagination"></div>
</div>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000, // Délai en millisecondes entre chaque diapositive (par exemple, 5 secondes)
        },
    });
</script>
    <!-- Activités End -->

<!-- Call To Action Start -->
<section class="cta" data-aos="fade-up" data-aos-delay="0" style="margin-top:-1%;">
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
    <br><br>
        <!-- Formation And Activité Start -->
    <div>
    <h1 style="color:#170963; margin-left:30%; font-style:normal;">Formations And Activités</h1>
    <a data-aos="fade-right" data-aos-delay="900" href="#" class="btn btn-primary" style="margin-left:10%; margin-top: -8%;">Conference</a>
    <div style="margin-left:65%; margin-top:-5%;">
        <?php
if (isset($_SESSION['id'])) {

    $id_encadrent = $_SESSION['id'];

    $sql = "SELECT role FROM roles WHERE id_encadrent = '$id_encadrent'";
    $result = mysqli_query($connexion, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $rowRole = mysqli_fetch_assoc($result);
        $userRole = $rowRole['role'];
        if ($userRole == "Directeur" || $userRole == "Responsable") {
            echo '<a href="activité_ltim.php">Ajouter une Activité?</a>
                <a href="activité_ltim.php">Ajouter un Formation?</a>';
        }
    }
}
?>
</div>
    <div>
    <br><br>
    <section class="Formation-Activité">
    <div class="formations_activités">
    <?php
    $sql_Activité_formation = "SELECT 'activité_labos' AS type, titre_activité AS title, fichier, date_creation, date_conference AS date_event FROM activité_labos 
                           UNION ALL 
                           SELECT 'formation_transversale' AS type, name_formation AS title, fichier, date_creation, NULL AS date_event FROM formation_transversale 
                           ORDER BY date_creation DESC
                           LIMIT 10";
            
    $resultat = mysqli_query($connexion, $sql_Activité_formation);

    $currentDate = date('Y-m-d');

    while ($rowx = mysqli_fetch_assoc($resultat)) {
        $dateCreation = $rowx['date_creation'];

        $fichierFileName = $rowx['fichier'];
        $fichierPath = 'pdf_base/' . $fichierFileName;

        echo "<div style='border: 1px solid #a5a3a3; box-shadow: 12px 0 15px -4px #a5a3a3,-12px 0 8px -4px #a5a3a3; padding-top: 4%; padding-bottom: 4%; padding-left:15%;' class='" . ($dateCreation <= $currentDate ? 'archive-item' : 'current-item') . "'>";

        echo '<a href="details_fichier.php?file=' . base64_encode($fichierFileName) . '" target="_blank">' .'<h3>' . $rowx['title'] . '</h3></a><br>';
    
        if ($rowx['date_event']) {
            echo "<h4 style='color: #afe3d7; font-size: 116%; sfont-weight: bold;'>" . $rowx['date_event'] . "</h4><br>";
        }
    
        echo "</div>";
    }
    ?>
    </div>
</section>

    <!-- Formation And Activité End -->
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