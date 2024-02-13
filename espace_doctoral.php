<?php
include 'connexion.php';
session_start ();
$idDoctoral = $_SESSION['id'];
$nomDoctoral = $_SESSION['nom'];
$prenomDoctoral = $_SESSION['prenom'];
$sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctoral";
$resultatsql = mysqli_query($connexion,$sql);
if (isset($_GET['logout'])) {
    // Destruction de la session et déconnexion de l'utilisateur
    session_destroy();
    // Redirection vers la page de connexion ou toute autre page souhaitée
    header("Location: login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title><?php echo $prenomDoctoral . ' ' . $nomDoctoral ?></title>
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
        .testimonial-and-clients {
            background: url(../images/test-clients-bg.png) center center/cover no-repeat #afe3d7;
        }
        .testimonials {
            padding: 95px 0 85px;
            color: #170936;
            border-bottom: 1px solid #26264b;
        }
        .formSection {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #170936;
            width: 100%;
            height: 300px;
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
                $idDoctoral = $_SESSION['id'];
                $sqlDoctorant = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctoral";
                $resultatDoctorant = mysqli_query($connexion, $sqlDoctorant);
                if (mysqli_num_rows($resultatDoctorant) > 0) {
                    $row = mysqli_fetch_assoc($resultatDoctorant);
                    // Récupérer les informations du doctorant
                    $nomDoctoral = $row['nom'];
                    $prenomDoctoral = $row['prenom'];
                    $loginDoctoral = $row['login'];
                    $imageDoctoral = $row['image'];
                    $idEncadrenr = $row['id_encadrent'];
                    $sqlProf = "SELECT * FROM professeur WHERE id_encadrent = $idEncadrenr";
                    $resultatProf = mysqli_query($connexion, $sqlProf);
                    if (mysqli_num_rows($resultatProf) > 0) {
                        $rowProfesseur = mysqli_fetch_assoc($resultatProf);
                        // Accéder aux données de l'équipe
                        $nomProf = $rowProfesseur['nom'];
                        $prenomProf = $rowProfesseur['prenom'];

                        // Afficher les informations du doctorant
                        echo "<h2> Encadré par : $nomProf  $prenomProf</h2>";
                        echo '<h4><a href="information-doctoral.php?id_doctorant=' . $idDoctoral . '"> ' . $nomDoctoral . ' ' . $prenomDoctoral . '</a></h4>';
                        echo "<a href='$loginDoctoral' style='color: #afe3d7;'>$loginDoctoral</a>";
                        }
                    }
                ?>        
                </div>
                <div class="subscribe-btn" data-aos="fade-left" data-aos-delay="400" data-aos-offset="0">
                <?php
$idDoctoral = $_SESSION['id'];
$sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctoral";
$resultatsql = mysqli_query($connexion, $sql);

if (mysqli_num_rows($resultatsql) > 0) {
    $row = mysqli_fetch_assoc($resultatsql);
    $imageFileName = $row['image'];
    $imagePath = 'image_base/' . $imageFileName;

    // Vérifier si le fichier image existe
    if (file_exists($imagePath)) {
        // Lire les données binaires de l'image
        $imageData = file_get_contents($imagePath);//unn erreur ici
        // Encoder les données en base64
        $imageBase64 = base64_encode($imageData);

        // Afficher l'image à partir des données encodées en base64
        echo '<img class="mr-4" src="data:image/jpeg;base64,' . $imageBase64 . '" alt="Image">';
    } else {
        $idprof = $_SESSION['id'];
        $sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctoral";
        $resultatsql = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($resultatsql) > 0) {
            $row = mysqli_fetch_assoc($resultatsql);
            echo '<img class="mr-4" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Image">';
        } else {
            echo 'Image introuvable.';
        }
    }
}else {
        echo '<img class="mr-4" src="assets/images/f3.png" alt="Image">';
    }
?>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action End -->

    <!-- Affiche Article Start -->
    <section class="services">
        <div class="container">
            <div class="title text-center">
                <h1 class="title-blue"><a name="articles">******Articles******</a></h1>
            </div>
        <div class="container">
            <div class="row">
            <?php
            $idDoctorant = $_SESSION['id'];
$sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";
$resultatsql = mysqli_query($connexion, $sql);

if ($resultatsql && mysqli_num_rows($resultatsql) > 0) {
    $row = mysqli_fetch_assoc($resultatsql);
    $idDoctorant = $row['id_doctorant'];
    $sqlArticle = "SELECT * FROM article_doctorant WHERE id_doctorant = $idDoctorant";
    $resultatArticle = mysqli_query($connexion, $sqlArticle);

    if ($resultatArticle && mysqli_num_rows($resultatArticle) > 0) {
        $counter = 1;

        while ($rowArticle = mysqli_fetch_assoc($resultatArticle)) {
            $nomArticle = $rowArticle['nom_article'];
            $fichierFileName = $rowArticle['fichier']; // Nom du fichier PDF
            $fichierPath = 'pdf_base/' . $fichierFileName; // Chemin complet vers le fichier PDF 
            
            echo '<div class="col-sm-6 col-lg-4">
                <div class="media" data-aos="fade-up" data-aos-delay="' . ($counter * 200) . '" data-aos-duration="' . ($counter * 200 + 200) . '">
                    <img class="mr-4" src="assets/images/service5-modified.png" alt="Web Development">
                    <div class="media-body">
                        <h5>'.$nomArticle.'</h5>
                        <a href="details_fichier.php?file='.base64_encode($fichierFileName).'" target="_blank">détails...</a>
                    </div>
                </div>
            </div>';
            
            $counter++;
        }
    } else {
        echo "No articles found.";
    }
} else {
    echo "No doctoral record found.";
}

?>
                </div>
            </div>
        </div>
    </section>
    <!-- Affiche Article End -->

    <!--ajouter article start-->
        <section class="formSection">
            <div class="title text-center" style="margin-left: -15%; margin-top: -10%;">
                <h3 class="title-primary"style="font-size:30px;"><a name="formation">Ajouter Article</a></h3>
            </div>
            <div id="formContainer" style="margin-left: 15%;">
                <form action="article.php" method="POST" enctype="multipart/form-data">
                    <label>Article:</label> <br>
                    <input type="text" placeholder="ajouter le nom de formation" name="nom_article" class="image"/><br>
                    <label>Date:</label> <br>
                    <input type="date" placeholder="JJ-MM-YYYY" name="date" class="image"/><br>
                    <label>Justification:</label> <br>
                    <input type="file" value="ajouter une photo" name="fichier" class="image"/><br><br>
                    <input type="submit" name="submit_formation" value="envoyer" style="background-color: #afe3d7; border-radius: 10px 0 10px 0;">
                </form>
            </div>
        </section>
    <!--ajouter article end-->
            
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
                                <form action="communication.php" method="POST" enctype="multipart/form-data">
                                    <label>Intitule:</label> <br>
                                    <input type="text" placeholder="ajouter le nom de formation" name="nom_commun" class="image"/><br>
                                    <label>Nature: </label><br>
                                    <select name="nature" id="nature">
                                        <option value="">--aucun--</option>
                                        <option value="orale">Communication Orale</option>
                                        <option value="afficher">Communication Afficher</option>
                                        <option value="organisation">Organisation</option>
                                    </select><br>
                                    <label>Date:</label> <br>
                                    <input type="date" placeholder="JJ-MM-YYYY" name="date" class="image"/><br>
                                    <label>Lieu:</label> <br>
                                    <input type="text" name="lieu" class="image"/><br>
                                    <label>Justification :</label> <br>
                                    <input type="file" name="fichier" class="image"/><br><br>
                                    <input type="submit" name="submit_communication" value="envoyer" style="background-color: #afe3d7; border-radius: 10px 0 10px 0;">
                                </form>
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
    <!-- Formation Start -->
    <section class="featured" style="background-color: #170936; color: #fff;">
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
                                <form action="process.php" method="POST" enctype="multipart/form-data">
                                    <label>Formation:</label> <br>
                                    <input type="text" placeholder="Nom de formation" name="nom_formation" class="image"/><br>
                                    <label>Date:</label> <br>
                                    <input type="date" placeholder="JJ-MM-YYYY" name="date" class="image"/><br>
                                    <label>Time:</label> <br>
                                    <input type="time" placeholder="00h" name="temp" class="image" step="3600" /><br>
                                    <label>Justification:</label> <br>
                                    <input type="file" value="ajouter une photo" name="fichier" class="image"/><br><br>
                                    <input type="submit" name="submit_formation" value="envoyer" style="background-color: #afe3d7; border-radius: 10px 0 10px 0;">
                                </form>
                            </div>
                        </div> 
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="400" data-aos-duration="800" style="margin-left: 170%; margin-top: 10%;">
                    <div class="featured-img">
                        <img class="featured-big" src="assets/images/formation-transver.jpeg" style="width: 420px; height: 360px;" alt="Featured 1">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Formation End -->
    <!-- Autre Start -->
    <section class="featured">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="400" data-aos-duration="800" style="margin-bottom: -10%;">
                    <div class="featured-img">
                        <img class="featured-big" src="assets/images/img_formation.jpg" style="width: 422px; height: 360px;" alt="Featured 1">
                        <img class="featured-small" src="assets/images/img_formation.jpg" style="width: 242px; height: 231px;" alt="Featured 2">
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="400" data-aos-duration="800">
                    <div class="title">
                        <h2 class="title-blue" style="color: #afe3d7;"><a name="autre">Autre Activités</a></h2>
                        <p class="title-primary" style="color: #170936">vous avez fais une autre activité, n'oublier pas de mettre votre rapport ici.</p>
                    <div class="media-element d-flex justify-content-between">
                        <div class="media">
                            <i class="fa fa-magic mr-4"></i>
                            <div class="media-body">
                                <form action="process1.php" method="POST" enctype="multipart/form-data">
                                    <label>Activité:</label> <br>
                                    <input type="text" placeholder="ajouter le nom de formation" name="nom" class="image"/><br>
                                    <label>Date:</label> <br>
                                    <input type="date" placeholder="JJ-MM-YYYY" name="date" class="image"/><br>
                                    <label>Justification :</label> <br>
                                    <input type="file" name="fichier" class="image"/><br><br>
                                    <input type="submit" name="submit_activité" value="envoyer" style="background-color: #afe3d7; border-radius: 10px 0 10px 0;">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Autre End -->
    <!--ajouter une thèse start-->
    <section class="formSection" style="height: auto;">
            <div class="title text-center" style="margin-left: -15%; margin-top: -10%;">
                        <h1 class="title-primary"style="font-size:30px;"><a name="thèse">Partager votre thèse</a></h1>
                    </div>
                    <div class="media-element d-flex justify-content-between">
                        <div class="media" style="margin-left: 15%; margin-top: 5%; margin-bottom: 5%;">
                            <i class="fa fa-magic mr-4"></i>
                         <div class="form-container">
                    <form action="ajouter_thèse.php" method="POST" enctype="multipart/form-data">
                        <label>Thèse:</label> <br>
                        <input type="text" placeholder="Intitule de thèse" name="nom_thèse" class="image"/><br>
                        <label>Date de soutenance:</label> <br>
                        <input type="date" placeholder="JJ-MM-YYYY" name="date_soutenance" class="image"/><br>
                        <label for="nom_prenom">L'encadrent:</label><br>
                        <input type="text" name="nom_prenom" id="nom_prenom" placeholder="nom et prénom d'encadrent" required><br>
                        <label for="nombreJury">Nombre de jurys:</label><br>
                        <input type="number" id="nombreJury" name="nombreJury" min="1" required oninput="genererChampsJury()"><br>
                        <div id="juryContainer"></div>
                        <label>Rapport:</label> <br>
                        <input type="file" value="ajouter une photo" name="fichier" class="image"/><br><br>
                        <input type="submit" name="submit_formation" value="envoyer" style="background-color: #afe3d7; border-radius: 10px 0 10px 0;">
                </form>
            </div>
    </section>
    <script>
    function genererChampsJury() {
    var nombreJury = document.getElementById("nombreJury").value;
    var juryContainer = document.getElementById("juryContainer");

    // Supprimer les champs de jury précédemment générés
    juryContainer.innerHTML = "";

    // Générer les nouveaux champs de jury
    for (var i = 1; i <= nombreJury; i++) {
        var label = document.createElement("label");
        label.innerHTML = "Jury " + i + ":";
        juryContainer.appendChild(label);
        juryContainer.appendChild(document.createElement("br"));
        var input = document.createElement("input");
        input.type = "text";
        input.name = "Jury[]"; // Utilisation de la structure de tableau
        input.required = true;
        juryContainer.appendChild(input);

        juryContainer.appendChild(document.createElement("br"));
    }
}
</script>
    <!--ajouter une thèse end-->
    <br><br>
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