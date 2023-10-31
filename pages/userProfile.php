<?php
// session_start();

// include('../account/verifLogin.php');
// $role = verifLogin();
// if ($role === 3) {
//     header('Location: ./adminHome.php');
//     exit;
// }	

// include('../backend/cnx.php');

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
            <!-- TODO : deconnexion href='../account/deco.php' -->
            <section class="min-vh-100">
                <div class="row-1 banner" style="height: 200px;"></div>
                <div class="row-1 d-flex justify-content-between flex-column flex-md-row">
                    <div class="col d-flex flex-column">
                        <img src="../data/img/Mochi.jpg" alt="Photo de profil" class="rounded-circle profilepic mx-auto ml-md-5 img-thumbnail" style="height: 150px;">
                        <p class="text-white profile-title mx-auto ml-md-4">Lucaski SARL</p>
                    </div>
                    <div class="col my-auto d-flex justify-content-center justify-content-md-end ">
                        <button class="btn btn-modifier">Modifier profil</button>
                        <button class="btn btn-deconnexion"><a href="../account/deco.php" class="text-reset text-decoration-none">Se déconnecter</a></button>
                    </div>
                </div>

                <div class="row-1 infos">
                    <div>
                        <p>Votre N° de SIREN</p>
                        <p>123 456 789</p>
                    </div>
                    <div>
                        <p>Email</p>
                        <p>merlin.lucas@gmail.com</p>
                    </div>
                    <div>
                        <p>Numéro de téléphone</p>
                        <p>Non renseigné</p>
                    </div>
                    <div>
                        <p>Date d'inscription</p>
                        <p>31/10/2023</p>
                        <div class="row-1">
                            <div class="col-lg-12">
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




    <script>
        const $button = document.querySelector('#sidebar-toggle');
        const $wrapper = document.querySelector('#wrapper');

        $button.addEventListener('click', (e) => {
            e.preventDefault();
            $wrapper.classList.toggle('toggled');
        });
    </script>
</body>

</html>