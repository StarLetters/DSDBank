<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentions Légales</title>

    <link rel="shortcut icon" href="../data/img/LogoDSD.png" type="image/x-icon">

    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/varColor.css">
    <link rel="stylesheet" href="../css/mentions.css">
</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="col">
                <div class="row mb-3">
                    <div class="col-md-12 mt-5">
                        <h1 class="mt-5 mb-5 text-center">Mentions légales</h1>
                    </div>
                </div>
                <div class="align-items-center d-flex flex-column justify-content-center"> 
                    <div class="infos align-items-center d-flex flex-column justify-content-center mb-5">
                        <h2 class="d-flex justify-content-center">Informations légales :</h2>
                        <div class="justify-content-start">
                            <div class="mb-3">Ce site est un projet réalisé par des étudiants dans le cadre du BUT Informatique</div>
                            <div>Étudiants responsables du projet :</div>
                            <ul>
                                <li>Emeline Houangkeo</li>
                                <li>Lucas Merlin</li>
                                <li>Adrien Baffioni</li>
                                <li>Elias Lahlouh</li>
                            </ul>
                            <div>
                                Ce projet n'a pas de vocation commerciale ni professionnelle
                                réelle et n'est pas affilié à une entité ou une banque existante.
                                Il s'agit d'une simulation à des fins éducatives et académiques.
                            </div>
                        </div>
                    </div>
                    <div class="infos align-items-center d-flex flex-column justify-content-center mb-5">
                        <h2 class="d-flex justify-content-center">Propriété intellectuelle :</h2>
                        <div class="txt justify-content-start">
                            Tous les contenus originaux créés pour ce projet, y compris 
                            mais sans s'y limiter, les textes, les logos, les graphiques 
                            et les images, sont la propriété intellectuelle des étudiants 
                            responsables du projet "DSD Bank".
                        </div>
                    </div>
                    <div class="infos align-items-center d-flex flex-column justify-content-center mb-5">
                        <h2 class="d-flex justify-content-center">Utilisation des données :</h2>
                        <div class="txt justify-content-start">
                            Les informations collectées sur ce site, dans le cadre de formulaires,
                            ne seront en aucun cas utilisées à des fins commerciales.
                            Les données collectées dans le cadre de ce projet sont traitées
                            de manière confidentielle et ne seront pas partagées avec des tiers.
                        </div>
                    </div>
                    <div class="infos align-items-center d-flex flex-column justify-content-center mb-5">
                        <h2 class="d-flex justify-content-center">Cookies :</h2>
                        <div class="txt justify-content-start">
                            Ce site peut utiliser des cookies à des fins de démonstration et de fonctionnement interne du projet.
                            Aucune donnée personnelle n'est collectée via ces cookies.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../scripts/header.js"></script>
</body>

</html>