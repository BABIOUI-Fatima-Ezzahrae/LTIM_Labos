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
        .tableau-center {
            margin: 0 auto;
  max-width: 800px;
  padding: 20px;
  background-color: #afe3d7;
  border: 1px solid #ddd;
  border-radius: 10px;
}

.tableau-center table {
  width: 100%; /* Largeur du tableau à 100% */
  border-collapse: collapse; /* Fusion des bordures des cellules */
}

.tableau-center th,
.tableau-center td {
  padding: 8px; /* Espacement intérieur des cellules */
  text-align: left; /* Alignement du texte à gauche */
  border-bottom: 1px solid #ddd; /* Bordure inférieure des cellules */
  color: #170936;
  text-align: center;
}

.tableau-center th {
  background-color: #f9f9f9; /* Couleur de fond de l'en-tête du tableau */
  font-weight: bold; /* Police en gras pour l'en-tête */
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
    <header class="position-absolute w-100">
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
                                    <?php
                                    if (mysqli_num_rows($resultatsql) > 0) {
                                        $row = mysqli_fetch_assoc($resultatsql);
                                        $idEquipe = $row['id_équipe'];
                                        $sqlEquipe = "SELECT * FROM équipes WHERE id_équipe = $idEquipe";
                                        $resultatEquipe = mysqli_query($connexion, $sqlEquipe);
                                    // Vérifier si la requête a renvoyé des résultats
                                    if (mysqli_num_rows($resultatEquipe) > 0) {
                                        $rowEquipe = mysqli_fetch_assoc($resultatEquipe);
                                        
                                        // Accéder aux données de l'équipe
                                        $nomLabo = $rowEquipe['labos'];
                                        
                                        // Afficher le nom du laboratoire
                                        echo '<h1 data-aos="fade-right" data-aos-delay="200" style="margin-top:-15%">' . $nomLabo . '</h1>';
                                        
                                        // Continuer avec le reste du code
                                        // ...
                                    }
                                }
                                    ?>
                                    <a data-aos="fade-right" data-aos-delay="900" href="directeur_prof#member" class="btn btn-primary">Doctorants Member</a>
                                    <a data-aos="fade-right" data-aos-delay="900" href="directeur_prof#projet" class="btn btn-primary">Projet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="texture"></div>
        <div class="diag-bg"></div>
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
    <div class="tableau-center">
    <?php
$idDoctorant = $_GET['id_doctorant'];
$sqlDoctorant = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";
$resultatDoctorant = mysqli_query($connexion, $sqlDoctorant);

// Vérifier si un résultat a été trouvé
if (mysqli_num_rows($resultatDoctorant) > 0) {
    $rowDoctorant = mysqli_fetch_assoc($resultatDoctorant);
    $nom = $rowDoctorant['nom'];
    $prenom = $rowDoctorant['prenom'];
    $login = $rowDoctorant['login'];
    $pass = $rowDoctorant['pass'];
    $dateNaissance = $rowDoctorant['date_naissance'];
    $dateInscription = $rowDoctorant['date_inscription'];
    $dateSoutenance = $rowDoctorant['date_soutenance'];
    $image = $rowDoctorant['image'];
    $sujet = $rowDoctorant['sujet'];
    $contenutSujet = $rowDoctorant['contenut_sujet'];
    $idEncadrent = $rowDoctorant['id_encadrent'];
    $idEquipe = $rowDoctorant['id_équipe'];

    echo '<table>
            <tr>
                <th>Information</th>
                <th>Valeur</th>
            </tr>
            <tr>
                <td>Nom</td>
                <td>' . $nom . '</td>
            </tr>
            <tr>
                <td>Prénom</td>
                <td>' . $prenom . '</td>
            </tr>
            <tr>
                <td>Login</td>
                <td>' . $login . '</td>
            </tr>
            <tr>
                <td>Date de naissance</td>
                <td>' . $dateNaissance . '</td>
            </tr>
            <tr>
                <td>Date d\'inscription</td>
                <td>' . $dateInscription . '</td>
            </tr>
            <tr>
                <td>Date de soutenance</td>
                <td>' . $dateSoutenance . '</td>
            </tr>
            <tr>
            <td>Image</td>
            <td>';
    $idDoctorant = $_GET['id_doctorant'];
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
    
            // Afficher l'image à partir des données encodées en
            echo '<img style="width: 30%;" src="data:image/jpeg;base64,' . $imageBase64 . '" alt="Image">';
        } else {
            $idDoctorant = $_GET['id_doctorant'];
            $sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";
            $resultatsql = mysqli_query($connexion, $sql);
            if (mysqli_num_rows($resultatsql) > 0) {
                $row = mysqli_fetch_assoc($resultatsql);
                echo '<img style="width: 30%;" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Image">';
            } else {
                echo 'Image introuvable.';
            }
        }
    }
    
    echo '</td>
            </tr>
            <tr>
                <td>Sujet</td>
                <td>' . $sujet . '</td>
            </tr>
            <tr>
                <td>Discription du sujet</td>
                <td>' . $contenutSujet . '</td>
            </tr>
        </table>';
} else {
    echo "Aucun doctorant trouvé.";
}
?>
    </div>

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