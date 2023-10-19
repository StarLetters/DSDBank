<?php
session_start();





print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Inclure Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/Home.css">
    <link rel="stylesheet" href="../css/varColor.css">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barre latérale -->
            <div class="col-md-3 d-none d-md-block bg-dark sidebar">
                <img src="../data/img/LogoDSD.png" alt="Logo" class="logo img-fluid mt-3 mb-3">
                <nav>
                    <ul class="nav flex-column text-center">
                        <li class="nav-item"><a class="nav-link" href="#">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Analyse</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Mon portefeuille</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Compte</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Paramètres</a></li>
                    </ul>
                </nav>
                <div class="divider bg-secondary my-3"></div>
                <nav>
                    <ul class="nav flex-column text-center">
                        <li class="nav-item"><a class="nav-link" href="#">Sécurité</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Centre d'assistance</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Mode sombre</a></li>
                    </ul>
                </nav>
                <div class="profile-section mt-auto pt-7">
                    <div class="profile-picture text-center">
                        <img src="../data/img/LogoDSD.png" alt="Photo de profil" class="img-fluid rounded-circle">
                    </div>
                    <div class="profile-info text-center">
                        <div class="profile-name">Prénom Nom</div>
                        <div class="profile-profession">Profession</div>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">


                <!-- Section de profil -->
                <div class="text-center mt-5">
                    <h1 class="text-light">Bonjour, Lucas</h1>
                </div>
                <div class="text-center my-5">
                    <h2 class="text-light">Actualité</h2>
                </div>
                <div class="text-center my-5">
                    <h2 class="text-light">Votre solde</h2>
                </div>
                <div class="text-center my-5">
                    <h2 class="text-light">Mentions légales</h2>
                </div>
            </main>


        </div>
    </div>
</body>

</html>