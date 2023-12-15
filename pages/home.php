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
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="blurred-background"></div>
            <div id="content" class="content-show">
                <section id="content-wrapper" class="no-margin-bottom">
                    <div class="row-1">
                        <div class="col-lg-12 d-flex flex-column">
                            <h2 class="content-title text-white mt-5 text-left">Bonjour, <span>
                                    <?php echo $_SESSION['displayName']; ?>
                                    <br>
                                    Bienvenue dans DSD Bank
                                </span></h2>
                                <span>
                                    <h5>
                                        Profitez dès maintenant de la comptabilité à la fois simple et complète
                                    </h5>
                                </span>
                                <a href="../pages/userProfile.php" class="custom-button col-2">Voir mon profil</a>
                        </div>
                    </div>
                </section>
                <!-- <footer class="text-center text-white footer">
                    Mentions légales
                    <br><br><br>
                    © 2023, DSDBank Ltd, All Rights Reserved.
                </footer> -->
                    
            </div>
            <?php include('../includes/footer.html'); ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="../scripts/header.js"></script>
</body>

</html>