<?php

session_start();

require('../account/verifLogin.php');
$role = verifLogin();
if ($role !== 0) {
    if ($role === 1) {
        header('Location: ../pages/poProfile.php');
    } else if ($role === 2) {
        header('Location: ../pages/adminHome.php');
    } else {
        header('Location: ../pages/welcome.php');
    }
}

include('../backend/cnx.php');
$email = $_SESSION['email'];
$request = "SELECT * FROM Utilisateur JOIN Entreprise ON Utilisateur.idUtilisateur = Entreprise.idUtilisateur WHERE email = :email;";
$result = $cnx->prepare($request);
$result->bindParam(':email', $email);
$result->execute();
$result = $result->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="shortcut icon" href="../data/img/LogoDSD.png" type="image/x-icon">

    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/userProfile.css">
    <link rel="stylesheet" href="../css/varColor.css">

</head>

<body>
    <div id="wrapper">

        <?php include('../includes/header.php'); ?>

        <div id="modal" class="modal">
            <div class="modal-content">
                <div class="col-12 p-0">
                    <div class="row-1">
                        <a class="close align-top pe-auto" onclick="closeModifier()">&times;</a>
                        Que souhaitez vous faire ?
                    </div>
                    <a href="demandereinit.html" class="text-decoration-none">
                        <div class="row-1 option"> Modifier le mot de passe</div>
                    </a>
                </div>
            </div>
        </div>
        <section class="min-vh-100">
            <div class="row-1 banner" style="height: 200px;"></div>
            <div class="row-1 d-flex justify-content-between flex-column flex-md-row">
                <div class="col d-flex flex-column">
                    <img src="../data/img/Mochi.jpg" alt="Photo de profil" class="rounded-circle profilepic mx-auto ml-md-5 img-thumbnail" style="height: 150px;">
                    <p class="text-white profile-title mx-auto ml-md-4"> <?php echo $result[0]['raisonSociale'] ?></p>
                </div>
                

                <div class="col d-flex flex-column align-items-center">
                    <p class="text-center mt-4" style="color:var(--couleur-text);"> Solde du compte au <?php 
                    $fmt = new IntlDateFormatter(
                        'fr_FR',
                        IntlDateFormatter::FULL,
                        IntlDateFormatter::NONE
                    );

                    echo $fmt->format(new DateTime());


                    ?></p> 
                                    <?php
                                    echo "<p ";
                                    $request1 = "SELECT * FROM Transaction WHERE idUtilisateur = :idUtilisateur;";
                                    $result1 = $cnx->prepare($request1);
                                    $result1->bindParam(':idUtilisateur', $result[0]['idUtilisateur']);
                                    $result1->execute();
                                    $result1 = $result1->fetchAll();
                                    $montant = 0;
                                    for ($i = 0; $i < count($result1); $i++) {
                                        if ($result1[$i]['sens'] == "-") {
                                            $montant -= $result1[$i]['montant'];
                                        } else {
                                            $montant += $result1[$i]['montant'];
                                        }
                                    }
                                    echo "style =\"font-size:1.75rem; font-weight:450; ";
                                    if ($montant < 0) {
                                        echo "color: red;";
                                    } else {
                                        echo "color: #3be145;";
                                    } 
                                    echo "\"";
                                    ?>                                
                                    ><?php
                                        echo $montant." €</p>";
                                        ?>
                        </div>




                
                
                <div class="col my-auto d-flex justify-content-center justify-content-md-end ">
                    <button class="btn btn-modifier" onclick="openModifier()">Modifier profil</button>
                    <button class="btn btn-deconnexion"><a href="../account/deco.php" class="text-reset text-decoration-none">Se déconnecter</a></button>
                </div>
                    
            </div>
            <div class="row-1 d-flex flex-wrap justify-content-around mx-2 mt-5 mt-md-0 infos">
                <div class="col-12 col-md-6 col-lg-4">
                    <p class="titres">Informations Basiques</p>
                    <hr>
                    <div class="information">
                        <p class="titres-2">Votre N° de SIREN</p>
                        <p><?php echo $result[0]['numSiren'] ?></p>
                    </div>
                    <div class="information">
                        <p class="titres-2">Date d'inscription</p>
                        <p><?php echo $result[0]['inscriptionDate'] ?></p>
                    </div>
                </div>
                <hr class="d-md-none">
                <div class="col-12 col-md-6 col-lg-4">
                    <p class="titres">Informations de contact</p>
                    <hr>
                    <div class="information">
                        <p class="titres-2">Email</p>
                        <p><?php echo $result[0]['email'] ?></p>
                    </div>
                    <div class="information">
                        <p class="titres-2">Numéro de téléphone</p>
                        <p><?php echo (empty($result[0]['numTel'])) ? "Non renseigné" : $result[0]['numTel'] ?></p>
                    </div>
                </div>


        </section>

        <?php include('../includes/footer.html'); ?>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>



    <script src="../scripts/header.js"></script>
    <script>
        function openModifier() {
            document.getElementById("modal").style.display = "block";
            const $wrapper = document.querySelector('#wrapper');
            const largeurEcran = window.innerWidth;
            if (($wrapper.classList.contains('toggled') && window.innerWidth < 992) || (!$wrapper.classList.contains('toggled') && window.innerWidth > 992)) {
                $wrapper.classList.toggle('toggled'); //toggle the left sidebar
            }
        }

        function closeModifier() {
            document.getElementById("modal").style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target.className === "modal") {
                event.target.style.display = "none";
            }
        };
    </script>

</body>

</html>