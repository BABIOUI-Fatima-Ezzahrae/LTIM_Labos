<?php
include 'connexion.php';
session_start ();
$idDoctorant = $_SESSION['id'];
$nomDoctorant = $_SESSION['nom'];
$prenomDoctorant = $_SESSION['prenom'];

// Récupérer les informations des doctorants pour l'utilisateur connecté
$sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";
$resultatsql = mysqli_query($connexion,$sql);
$rowdoctoral = mysqli_fetch_assoc($resultatsql);
$idEquipe = $rowdoctoral['id_équipe'];

// Récupérer le nom de l'équipe du doctorant
$sqlEquipe = "SELECT équipe FROM équipes WHERE id_équipe = $idEquipe";
$resultEquipe = mysqli_query($connexion, $sqlEquipe);
$rowEquipe = mysqli_fetch_assoc($resultEquipe);
$nomEquipe = $rowEquipe['équipe'];
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title><?php echo $nomDoctorant . ' ' . $prenomDoctorant ?></title>
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
                <a class="navbar-brand" href="home.php" style="margin-top: -2%; margin-left: -2%;"><img src="assets/images/logo1.png" alt="Multipurpose"></a>
                <?php include 'menu.php' ?>
            </nav>
        </div>
    </header>
    <!-- Header End -->
    <!-- Hero Start -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-12 offset-md-1 col-md-11">
                    <div class="swiper-container hero-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide slide-content d-flex align-items-center">
                                <div class="single-slide">
                                    <h1 data-aos="fade-right" data-aos-delay="200"> Laboratoire de Technologie de l’Information et Modélisation (LTIM)</h1>
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
    <h1><br><br><br></h1>
    <!-- informations doctoral Start -->
    <div class="form-container">
    <?php 
    $idDoctorant = $_GET['id_doctorant'];
    $sql = "SELECT * FROM doctoral WHERE id_doctorant = $idDoctorant";
    $resultatsql = mysqli_query($connexion, $sql);
    while ($row = mysqli_fetch_assoc($resultatsql)) :  ?>
    <form>
    <input type="hidden" name="idDoctorant" value="<?php echo $row['id_doctorant']; ?>">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" value="<?php echo $row['nom']; ?>" required><br>

  <label for="prenom">Prénom :</label>
  <input type="text" name="prenom" id="prenom" value="<?php echo $row['prenom']; ?>" required><br>

  <label for="login">Login :</label>
  <input type="text" name="login" id="login" value="<?php echo $row['login']; ?>" required><br>

  <label for="date_naissance">Date de naissance :</label>
  <input type="date" name="date_naissance" id="date_naissance" value="<?php echo $row['date_naissance']; ?>" required><br>

  <label for="date_inscription">Date d'inscription :</label>
  <input type="date" name="date_inscription" id="date_inscription" value="<?php echo $row['date_inscription']; ?>" required><br>

  <label for="image">Image :</label>
  <input type="file" name="image" id="image" accept="image/*" required><br>

  <label for="sujet">Sujet :</label>
  <input type="text" name="sujet" id="sujet" value="<?php echo $row['sujet']; ?>" required><br>

  <label for="contenut_sujet">Axe :</label>
  <textarea name="nom_axe" id="thème" required></textarea><br>
  <input type="hidden" name="id_doctorant" value="<?php echo $idDoctorant; ?>" readonly><br>

</form>
    
<a href="#" onclick="toggleForm('passwordForm');">Modifier le mot de passe ?</a>
<div id="passwordForm" style="display: none;">
    <h2>Modifier le mot de passe</h2>
    <form action="modifier__doctoral.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_doctoral" value="<?php echo $row['id_doctorant']; ?>">
    
    <label for="password">Nouveau mot de passe:</label>
    <input type="password" name="password"><br>
    <label for="confirm_password">Confirmez le mot de passe:</label>
    <input type="password" name="confirm_password"><br><br>
    <input type="submit" name="submitPassword" value="Modifier le mot de passe">
    </form>
</div>

<a href="#" onclick="toggleForm('imageForm');">Modifier l'image ?</a>
<div id="imageForm" style="display: none;">
    <h2>Modifier l'image</h2>
    <form action="modifier__doctoral.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_doctoral" value="<?php echo $row['id_doctorant']; ?>">    
    <label for="image">Image:</label>
    <input type="file" name="image" accept="image/*"><br>        
    <input type="submit" name="submitImage" value="Modifier l'image">
    </form>
</div>

<script>
    function toggleForm(formId) {
        var form = document.getElementById(formId);
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>
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