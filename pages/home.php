<?php
session_start();
require('../account/verifLogin.php');
$verif = verifLogin();
switch ($verif) {
    case 0:
        break;
    case 1:
        header('Location: ../pages/poProfile.php');
        break;
    case 2: //ADMIN
        header('Location: ../pages/adminHome.php');
        break;
}
include('../backend/cnx.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="shortcut icon" href="../data/img/LogoDSD.png" type="image/x-icon">

    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/varColor.css">

</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="blurred-background"></div>
            <div id="content" class="content-show">
                
                <section id="content-wrapper">
                    <div class="row-1">
                        <div class="col-lg-12">
                            <h2 class="content-title text-white mt-5 text-left">Bonjour, <span>
                                    <?php
                                    echo $_SESSION['displayName'];
                                    ?>
                                <br>
                                Bienvenue dans DSD Bank
                                </span></h2>
                                <div class="col-10 d-flex flex-column">
                                <span><h5>
                                Profitez dès maintenant de la comptabilité à la fois simple et complète
                                </h5>
                            </span>

                            <a href="../pages/userProfile.php" class="custom-button col-2">Voir mon profil</a>

                            </div>
                        </div>
                    </div>

                </section>
            </div>


            <section class="text-center mt-5 content-after-profile">
                <h2 class="text-white mt-3">Qui sommes-nous ?</h2>
                <br><br>
                <h3 class="text-white">Le meilleur site pour gérer vos finances !</h3>
                <br><br>
                <div class="container">
                    <h5 class="text-white">Avec DSDBank, visualisez vos transactions de la meilleure des manières.
                        Remises, impayés, graphiques de stats, tout est là pour vous aider du mieux possible à faire évoluer votre commerce.</h5>
                </div>
            </section>

            <section class="text-center mt-5">
                <h2 class="text-white">Les avis clients</h2>
            </section>

            <div class="container text-center mt-5">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div id="clientCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <!-- Avis client 1 -->
                                <div class="carousel-item active">
                                    <img src="https://cdn-icons-png.flaticon.com/512/20/20863.png" class="img-fluid rounded-circle" class="d-block mx-auto" alt="Client 1">
                                    <h3 class="text-white">Nom Client 1</h3>
                                    <p class="text-white">Avis du client 1 ici...</p>
                                </div>

                                <!-- Avis client 2 -->
                                <div class="carousel-item">
                                    <img src="https://st.depositphotos.com/2101611/3925/v/450/depositphotos_39258143-stock-illustration-businessman-avatar-profile-picture.jpg" class="img-fluid rounded-circle" class="d-block mx-auto" alt="Client 2">
                                    <h3 class="text-white">Nom Client 2</h3>
                                    <p class="text-white">Avis du client 2 ici...</p>
                                </div>

                                <div class="carousel-item">
                                    <img src="https://cdn-icons-png.flaticon.com/512/20/20863.png" class="img-fluid rounded-circle" class="d-block mx-auto" alt="Client 3">
                                    <h3 class="text-white">Nom Client3</h3>
                                    <p class="text-white">Avis du client 3 ici...</p>
                                </div>

                            </div>

                            <!-- Contrôles de navigation -->
                            <a class="carousel-control-prev" href="#clientCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Précédent</span>
                            </a>
                            <a class="carousel-control-next" href="#clientCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Suivant</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('../includes/footer.html'); ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="../scripts/header.js"></script>
</body>

</html>