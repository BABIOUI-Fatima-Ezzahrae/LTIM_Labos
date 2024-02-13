<?php
include 'connexion.php';
session_start ();

$idProf = $_SESSION['id'];
$nomProf = $_SESSION['nom'];
$prenomProf = $_SESSION['prenom'];
$sql = "SELECT * FROM professeur WHERE id_encadrent = $idProf";
$resultatsql = mysqli_query($connexion,$sql);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title><?php echo $nomProf . ' ' . $prenomProf ?></title>
    <!-- Stylesheets & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/font-awesome.min.css">
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
<!-- Stylesheets & Fonts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        .mr-4{
            width: 60px;
            height: 60px;
        }
        .fa-thumbs-up,
    .fa-thumbs-down {
        font-size: 24px;
        color: green;
    }
    
    .fa-paper-plane {
        font-size: 18px;
        color: blue;
    }
    form {
  display: flex;
  flex-direction: column;
  margin-top: 30px;
}
label {
  font-weight: bold;
}
input[type="text"],
textarea {
  padding: 8px;
  margin: 5px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
  resize: vertical; 
  width: 60%;
}
.forum input[type = submit] {
    padding: 10px 20px;
        background-color: #afe3d7;
        color: rgba(24, 9, 53);
        border: none;
        border-radius: 20px 0 20px 0;
        cursor: pointer;
        width: 120px;
}
    /* CSS pour le conteneur du menu */
.menu-forum-liste {
  position: absolute;
  top: 28.4em;
  left: 0;
  bottom: 0;
  width: 18%;
  height: auto;
  overflow: auto;
}
.menu-forum-liste ul {
  list-style: none;
  margin: 0;
  padding: 0;
  background-color: #afe3d7; 
  border-radius: 10px;
}
.menu-forum-liste li {
  padding: 10px;
  border-bottom: 1px solid #ccc; 
}
.menu-forum-liste li a {
  text-decoration: none;
  color: #fff;
}
.menu-forum-liste li a:hover {
  color: #afe3d7;
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
    <section class="cta" data-aos="fade-up" data-aos-delay="0" style="margin-left:17%;">
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

        <!-- Menu forum start -->
    <section class="menu-forum-liste">
        <div class="menu-forum">
            <ul>
            <h2 style="color: #170936;">Liste des Sujets</h2>
                <?php
                $IDEncadrent = $_SESSION['id'];
                $sqlMenu = "SELECT n.* FROM forum n INNER JOIN professeur p ON n.id_encadrent= p.id_encadrent WHERE n.id_encadrent = $IDEncadrent ORDER BY n.date_creation DESC";
                $resultatMenu = mysqli_query($connexion,$sqlMenu);
                while ($rowMenu = mysqli_fetch_assoc($resultatMenu)) {
                    $Forum = $rowMenu['titre'];
                    $IdForum = $rowMenu['id_forum'];
                    echo '<li><a href="forum_doctoral.php?id_forum=' . $IdForum . '" style="color: #000;">' . $Forum . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </section>
    <!-- Menu forum end -->
<br>
    <!--Ajouter un sujet start-->
    <section class="forum" style="margin-left:20%;">
    <h1 style="color: #170936; text-align: center;">Nouveau Sujet</h1>
    <div>
        <form action="remplir_forum.php" method="POST" enctype="multipart/form-data">
            <label for="sujet">Sujet :</label>
            <input type="text" name="sujet" id="sujet" required><br>           
            <label for="description">Description :</label>
            <textarea name="description" id="description" required></textarea>
            <input type="submit" value="envoyer">
        </form>
    </div>
    </section>
    <!--Ajouter un sujet end-->

    
<!---->
<section class="services" style="margin-left: 20%; margin-top: -5%;">
        <div class="container">
            <div>
            <?php
           if(isset($_GET['id_forum'])){
            $IdForum = $_GET['id_forum'];
             $idDoctorant = $_SESSION['id'];
$sql = "SELECT f.*,p.* FROM forum f INNER JOIN professeur p ON f.id_encadrent = p.id_encadrent WHERE f.id_forum = $IdForum ORDER BY f.date_creation DESC LIMIT 1";
$resultatsql = mysqli_query($connexion, $sql);
     $counter=0;
        if (mysqli_num_rows($resultatsql) > 0) {
            $rowSujet = mysqli_fetch_assoc($resultatsql);
            $Id_forum = $rowSujet['id_forum'];            
            $Id_Encadrent= $rowSujet['id_encadrent'];
                    $Sujet = $rowSujet['titre'];
                    $Description = $rowSujet['sujet_forum'];
                    $Date = $rowSujet['date_creation'];
                    $Id_Encadrent = $rowSujet['id_encadrent'];
            
            echo '<div class="col-sm-6 col-lg-4">
                <div class="media" data-aos="fade-up" data-aos-delay="' . ($counter * 200) . '" data-aos-duration="' . ($counter * 200 + 200) . '">
                ';
                $sqlImage = "SELECT * FROM professeur WHERE id_encadrent = $Id_Encadrent";
                $resultatImage = mysqli_query($connexion, $sqlImage);
                
                if (mysqli_num_rows($resultatImage) > 0) {
                    $row = mysqli_fetch_assoc($resultatImage);
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
                        $sqlImage = "SELECT * FROM professeur WHERE id_encadrent = $Id_Encadrent";
                        $resultProf = mysqli_query($connexion, $sqlImage);
                        if (mysqli_num_rows($resultProf) > 0) {
                            $row = mysqli_fetch_assoc($resultProf);
                            echo '<img class="mr-4" src="data:image/jpeg;base64,' . base64_encode($row['imags']) . '" alt="Image">';
                        } else {
                            echo 'Image introuvable.';
                        }
                    }
                }                    
                echo'<div class="media-body">
                        <h4>'.$Sujet.'</h4><hr>
                        <p>'.$Description.'</p>
                        <h6>'.$Date.'</h6>
                    </div>
                </div>
            </div>';
            
            $counter++;
        }

?>
            </div>
        </div>
    </section>
    <!--Afficher un sujet et envoyer un reponse end-->

    <!--Afficher les reponses et envoyer un commantaire start-->
    <section class="services" style="margin-left: 20%; margin-top: -10%;">
        <div class="container">
            <div class="row">
            <?php
$sqlMessage = "SELECT m.*, p.id_forum FROM messages m INNER JOIN forum p ON m.id_forum = p.id_forum WHERE p.id_forum = $IdForum ORDER BY m.date_creation DESC";
$resultatMessage = mysqli_query($connexion, $sqlMessage);
     $counter=0;
        while ($rowMessage = mysqli_fetch_assoc($resultatMessage)) {
            $Id_forum = $rowMessage['id_message'];
            $idDoctorant = $rowMessage['id_doctorant'];
            $Contenue = $rowMessage['contenue'];
            $Date = $rowMessage['date_creation'];
            
            echo '<div class="col-sm-6 col-lg-4">
                <div class="media" data-aos="fade-up" data-aos-delay="' . ($counter * 200) . '" data-aos-duration="' . ($counter * 200 + 200) . '">';
                $sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";
                $resultatsql = mysqli_query($connexion, $sql);
                if (mysqli_num_rows($resultatsql) > 0) {
                    $row = mysqli_fetch_assoc($resultatsql);
                    $imageFileName = $row['image'];
                    $imagePath = 'image_base/' . $imageFileName;
                
                    // Vérifier si le fichier image existe
                    if (file_exists($imagePath)) {
                        // Lire les données binaires de l'image
                        $imageData = file_get_contents($imagePath);
                        // Encoder les données en base64
                        $imageBase64 = base64_encode($imageData);
                        $Nom = $row['nom'];
                        $Prenom = $row['prenom'];
                
                        // Afficher l'image à partir des données encodées en base64
                        echo '<img class="mr-4" src="data:image/jpeg;base64,' . $imageBase64 . '" alt="Image">
                        <div class="media-body">
                        <h4>'.$Nom.' '.$Prenom.'</h4>';
                    } else {
                        $idprof = $_SESSION['id'];
                        $sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";
                        $resultatsql = mysqli_query($connexion, $sql);
                        if (mysqli_num_rows($resultatsql) > 0) {
                            $row = mysqli_fetch_assoc($resultatsql);
                            $Nom = $row['nom'];
                        $Prenom = $row['prenom'];
                            echo '<img class="mr-4" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Image">
                            <div class="media-body">
                            <h4>'.$Nom.' '.$Prenom.'</h4>';
                         } else {
                            echo 'Image introuvable.';
                        }
                    }
                }    
                echo'   <p>'.$Contenue.'</p>
                        <h6>'.$Date.'</h6>
                    </div>
                    
                </div>
            </div>';
            
            $counter++;
        }
    }else { 
?>
            </div>
        </div>
    </section>
    <!---->
<!--Afficher un sujet et envoyer un reponse start-->
<section class="services" style="margin-left:20%;">
        <div class="container">
            <div>
            <?php
            $idprof = $_SESSION['id'];
$sql = "SELECT * FROM forum WHERE id_encadrent = $idprof ORDER BY date_creation DESC LIMIT 1";
$resultatsql = mysqli_query($connexion, $sql);
     $counter=0;
        if (mysqli_num_rows($resultatsql) > 0) {
            $rowSujet = mysqli_fetch_assoc($resultatsql);
            $Id_forum = $rowSujet['id_forum'];            
            $Id_Encadrent= $rowSujet['id_encadrent'];
                    $Sujet = $rowSujet['titre'];
                    $Description = $rowSujet['sujet_forum'];
                    $Date = $rowSujet['date_creation'];
            
            echo '<div class="col-sm-6 col-lg-4">
                <div class="media" data-aos="fade-up" data-aos-delay="' . ($counter * 200) . '" data-aos-duration="' . ($counter * 200 + 200) . '">
                ';
                $sqlImage = "SELECT * FROM professeur WHERE id_encadrent = $idprof";
                $resultatImage = mysqli_query($connexion, $sqlImage);
                
                if (mysqli_num_rows($resultatImage) > 0) {
                    $row = mysqli_fetch_assoc($resultatImage);
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
                        $sqlImage = "SELECT * FROM professeur WHERE id_encadrent = $idprof";
                        $resultProf = mysqli_query($connexion, $sqlImage);
                        if (mysqli_num_rows($resultProf) > 0) {
                            $row = mysqli_fetch_assoc($resultProf);
                            echo '<img class="mr-4" src="data:image/jpeg;base64,' . base64_encode($row['imags']) . '" alt="Image">';
                        } else {
                            echo 'Image introuvable.';
                        }
                    }
                }                    
                echo'<div class="media-body">
                        <h4>'.$Sujet.'</h4><hr>
                        <p>'.$Description.'</p>
                        <h6>'.$Date.'</h6>
                    </div>
                </div>
            </div>';
            
            $counter++;
        }

?>
            </div>
        </div>
    </section>
    <!--Afficher un sujet et envoyer un reponse end-->

    <!--Afficher les reponses et envoyer un commantaire start-->
    <section class="services" style="margin-left:20%;">
        <div class="container">
            <div class="row">
            <?php
$sqlMessage = "SELECT m.*, f.id_forum FROM messages m INNER JOIN forum f ON m.id_forum = f.id_forum ORDER BY m.date_creation DESC";
$resultatMessage = mysqli_query($connexion, $sqlMessage);
     $counter=0;
        while ($rowMessage = mysqli_fetch_assoc($resultatMessage)) {
            $Id_forum = $rowMessage['id_message'];
            $idDoctorant = $rowMessage['id_doctorant'];
            $Contenue = $rowMessage['contenue'];
            $Date = $rowMessage['date_creation'];
            
            echo '<div class="col-sm-6 col-lg-4">
                <div class="media" data-aos="fade-up" data-aos-delay="' . ($counter * 200) . '" data-aos-duration="' . ($counter * 200 + 200) . '">';
                $sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";
                $resultatsql = mysqli_query($connexion, $sql);
                if (mysqli_num_rows($resultatsql) > 0) {
                    $row = mysqli_fetch_assoc($resultatsql);
                    $imageFileName = $row['image'];
                    $imagePath = 'image_base/' . $imageFileName;
                
                    // Vérifier si le fichier image existe
                    if (file_exists($imagePath)) {
                        // Lire les données binaires de l'image
                        $imageData = file_get_contents($imagePath);
                        // Encoder les données en base64
                        $imageBase64 = base64_encode($imageData);
                        $Nom = $row['nom'];
                        $Prenom = $row['prenom'];
                
                        // Afficher l'image à partir des données encodées en base64
                        echo '<img class="mr-4" src="data:image/jpeg;base64,' . $imageBase64 . '" alt="Image">
                        <div class="media-body">
                        <h4>'.$Nom.' '.$Prenom.'</h4>';
                    } else {
                        $idprof = $_SESSION['id'];
                        $sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";
                        $resultatsql = mysqli_query($connexion, $sql);
                        if (mysqli_num_rows($resultatsql) > 0) {
                            $row = mysqli_fetch_assoc($resultatsql);
                            $Nom = $row['nom'];
                        $Prenom = $row['prenom'];
                            echo '<img class="mr-4" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Image">
                            <div class="media-body">
                            <h4>'.$Nom.' '.$Prenom.'</h4>';
                         } else {
                            echo 'Image introuvable.';
                        }
                    }
                }    
                echo'   <p>'.$Contenue.'</p>
                        <h6>'.$Date.'</h6>
                    </div>
                    
                </div>
            </div>';
            
            $counter++;
        }
    }  
?>
            </div>
        </div>
    </section>
    <!--Afficher les reponses et envoyer un commantaire end-->

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
                                <li><a href="https://www.facebook.com/fh5co" target="_blank"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
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