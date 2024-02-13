<?php
include 'connexion.php';
session_start ();
$idResponsable = $_SESSION['id'];
$nomResponsable = $_SESSION['nom'];
$prenomResponsable = $_SESSION['prenom'];

// Récupérer les informations des professeurs pour l'utilisateur connecté
$sql = "SELECT * FROM professeur WHERE id_équipe = (SELECT id_équipe FROM professeur WHERE id_encadrent = $idResponsable)";
$resultatsql = mysqli_query($connexion,$sql);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title><?php echo $nomResponsable . ' ' . $prenomResponsable ?></title>
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
    <h1><br><br><br></h1>
    <!-- ajouter un professeur Start -->
    <div class="form-container">
    <?php 
    $id_prof = $_GET['id_encadrent'];
    $sql = "SELECT p.*, e.équipe, r.role
        FROM professeur p
        INNER JOIN équipes e ON p.id_équipe = e.id_équipe
        INNER JOIN roles r ON p.id_encadrent= r.id_encadrent
        WHERE p.id_encadrent = $id_prof";
    $resultatsql = mysqli_query($connexion, $sql);
    while ($row = mysqli_fetch_assoc($resultatsql)) :  ?>
    <form action="modifierProf.php" method="post" enctype="multipart/form-data">
    <h2>Modifier un professeur</h2>
    <input type="hidden" name="idProf" value="<?php echo $row['id_encadrent']; ?>">
    
    <label for="nom">Nom:</label>
    <input type="text" name="nom" value="<?php echo $row['nom']; ?>" required><br>

    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>" required><br>

    <label for="specialite">Spécialité:</label>
    <input type="text" name="specialite" value="<?php echo $row['specialite']; ?>"><br>

    <label for="CIN">CIN:</label>
    <input type="text" name="CIN" value="<?php echo $row['CIN']; ?>" required><br>

    <label for="image">Image:</label>
    <input type="file" name="image" accept="image/*"><br>

    <label for="équipe">équipe:</label>
    <input type="text" name="équipe" value="<?php echo $row['équipe']; ?>" required><br>

    <label for="role">Rôle:</label>
    <input type="text" name="role" value="<?php echo $row['role']; ?>" required><br>
    
    <label for="login">Login:</label>
    <input type="text" name="login" value="<?php echo $row['login']; ?>" required><br><br>
    
    <input type="submit" value="Modifier">
</form>
<?php endwhile; ?>
</div>
<!-- ajouter un professeur Start -->
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