<?php
/*
session_start();

require('../account/verifLogin.php');
$verif = verifLogin();	
if ($verif !== 0){
    header('Location: ../pages/welcome.php');
}

*/

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>


    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/userProfile.css">
    <link rel="stylesheet" href="../css/varColor.css">

</head>

<body>
    <div class="">
        <div id="wrapper">

            <?php include('../includes/header.html'); ?>

            <!-- TODO : Afficher les informations de l'utilisateur -->

            <!-- TODO : Bouton modifier profil -> popup modifier mdp (href=demandereinit.html) -->
            <div id="modal" class="modal">
                <div class="modal-content">
                    <div class="col-12 p-0">
                        <div class="row-1">
                        <a class="close align-top pe-auto" onclick="closeModifier()">&times;</a>
                            Que voulez vous faire ?
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
                        <p class="text-white profile-title mx-auto ml-md-4">Lucaski SARL</p>
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
                            <p>123 456 789</p>
                        </div>
                        <div class="information">
                            <p class="titres-2">Date d'inscription</p>
                            <p>31/10/2023</p>
                        </div>
                    </div>
                    <hr class="d-md-none">
                    <div class="col-12 col-md-6 col-lg-4">
                        <p class="titres">Informations de contact</p>
                        <hr>
                        <div class="information">
                            <p class="titres-2">Email</p>
                            <p>merlin.lucas@gmail.com</p>
                        </div>
                        <div class="information">
                            <p class="titres-2">Numéro de téléphone</p>
                            <p>Non renseigné</p>
                        </div>
                    </div>
                    <div class="col-12 my-5">
                        <div class="row-1 d-flex">
                            <div class="col-lg-12 d-flex justify-content-center">
                                <div class="card">
                                    <div class="logo">
                                        <img src="../data/img/LogoDSD.png" alt="logo">
                                    </div>
                                    <div class="chip"><img src="../data/img/chip.png" alt="chip"></div>
                                    <div class="number">1234 5678 9012 3456</div>
                                    <div class="name">Prenom Nom</div>
                                    <div class="from">10/19</div>
                                    <div class="to">06/21</div>
                                    <div class="ring"></div> <!-- les cercles en fond -->
                                </div>
                            </div>
                        </div>
                    </div>

            </section>

            <footer class="text-center text-white footer">
                Mentions légales
                <br><br><br>
                © 2023, DSDBank Ltd, All Rights Reserved.
            </footer>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>



    <script src="../scripts/header.js"></script>
    <script>
        function openModifier() {
            document.getElementById("modal").style.display = "block";
            const $wrapper = document.querySelector('#wrapper');
            const largeurEcran = window.innerWidth;
            console.log(largeurEcran);
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