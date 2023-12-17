<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipe</title>

    <link rel="shortcut icon" href="../data/img/LogoDSD.png" type="image/x-icon">

    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    
    <!-- Inclure les icônes de font awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/varColor.css">
    <link rel="stylesheet" href="../css/equipe.css">
</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="col">
                <div class="row mb-3">
                    <div class="col-md-12 mt-5">
                        <h1 class="mt-5 mb-5 text-center">Rencontrez l'équipe : </h1>
                    </div>
                </div>
                <!-- 1ère ligne -->
                <div class="ligne align-items-start d-flex justify-content-around mb-5">
                    <section class="personne align-items-center d-flex flex-column justify-content-center mb-5">
                        <h2 class="mb-3 text-center">MERLIN Lucas</h2>
                        <img class="elgato mb-3" src="../data/img/elgatolulu.png" alt="elgato">
                        <div class="d-flex justify-content-between">
                            <div class="roles-container mr-5">
                                <h3>Rôles</h3>
                                <div class="roles d-flex flex-column justify-content-start">
                                    <div>Chef de projet</div>
                                    <div>Expert</div>
                                    <div>Perfectionneur</div>
                                </div>
                            </div>
                            <div>
                                <h3>Réseaux</h3>
                                <div class="d-flex justify-content-around">
                                    <a class="reseau" href="https://github.com/Luucas7" target="_blank">
                                        <i class="fab fa-github icone"></i> <!-- Icône GitHub -->
                                    </a>
                                    <a  class="reseau" href="https://www.linkedin.com/in/lucas-merlin-a5b08426b/" target="_blank">
                                        <i class="fab fa-linkedin icone"></i></i> <!-- Icône LinkedIn -->
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="personne align-items-center d-flex flex-column justify-content-start">
                        <h2 class="mb-3 text-center">HOUANGKEO Emeline</h2>
                        <img class="elgato mb-3" src="../data/img/elgatoemeu.png" alt="elgato">
                        <div class="d-flex justify-content-between">
                            <div class="roles-container mr-5">
                                <h3>Rôles</h3>
                                <div class="roles d-flex flex-column justify-content-start">
                                    <div>Priseuse</div>
                                    <div>Promoteuse</div>
                                </div>
                            </div>
                            <div>
                                <h3>Réseaux</h3>
                                <div class="d-flex justify-content-around">
                                    <a class="reseau" href="https://github.com/Hyprra" target="_blank">
                                        <i class="fab fa-github icone" ></i>
                                    </a>
                                    <a  class="reseau" href="https://www.linkedin.com/in/emeline-houangkeo-5b8879266/" target="_blank">
                                        <i class="fab fa-linkedin icone"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- 2ème ligne -->
                <div class="ligne align-items-start d-flex justify-content-around">
                    <section class="personne align-items-center d-flex flex-column justify-content-center mb-5">
                        <h2 class="mb-3 text-center">BAFFIONI Adrien</h2>
                        <img class="elgato mb-3" src="../data/img/elgatoadridri.png" alt="elgato">
                        <div class="d-flex justify-content-between">
                            <div class="roles-container mr-5">
                                <h3>Rôles</h3>
                                <div class="roles d-flex flex-column justify-content-start">
                                    <div>Organisateur</div>
                                    <div>Soutien</div>
                                </div>
                            </div>
                            <div>
                                <h3>Réseaux</h3>
                                <div class="d-flex justify-content-around">
                                    <a class="reseau" href="https://github.com/AdrienB23" target="_blank">
                                        <i class="fab fa-github icone"></i>
                                    </a>
                                    <a  class="reseau" href="https://www.linkedin.com/in/adrien-baffioni-83465a26a/" target="_blank">
                                        <i class="fab fa-linkedin icone"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="personne align-items-center d-flex flex-column justify-content-center">
                        <h2 class="mb-3 text-center">LAHLOUH Elias</h2>
                        <img class="elgato mb-3" src="../data/img/elgatoelinette.png" alt="elgato">
                        <div class="d-flex justify-content-between">
                            <div class="roles-container mr-5">
                                <h3>Rôles</h3>
                                <div class="roles d-flex flex-column justify-content-start">
                                    <div>Propulseur</div>
                                    <div>Coordinateur</div>
                                </div>
                            </div>
                            <div>
                                <h3>Réseaux</h3>
                                <div class="d-flex justify-content-around">
                                    <a class="reseau" href="https://github.com/Eliaslhl" target="_blank">
                                        <i class="fab fa-github icone"></i>
                                    </a>
                                    <a  class="reseau" href="https://www.linkedin.com/in/elias-lahlouh-1332a1243/" target="_blank">
                                        <i class="fab fa-linkedin icone"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="../scripts/header.js"></script>
</body>

</html>