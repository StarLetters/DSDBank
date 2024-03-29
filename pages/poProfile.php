<?php

session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 1) {
    header('Location: ../pages/welcome.php');
}

include('../backend/cnx.php');

// Récupération du nombre de demandes d'inscription et de suppression
$request = "SELECT type_requete, COUNT(*) FROM POrequete WHERE type_requete IN ('inscription', 'suppression') GROUP BY type_requete;";
$result = $cnx->prepare($request);
$result->execute();
$result = $result->fetchAll(PDO::FETCH_KEY_PAIR);
$nbInscr = $result['inscription'] ?? 0;
$nbSupp = $result['suppression'] ?? 0;

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PO Profile</title>
    <link rel="shortcut icon" href="../data/img/LogoDSD.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/poProfile.css">
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
                    <img src="../data/img/DefaultUser.png" alt="Photo de profil" class="rounded-circle profilepic mx-auto ml-md-5 img-thumbnail" style="height: 150px;">
                    <p class="text-white profile-title mx-auto ml-md-4">Responsable</p>
                </div>
                <div class="col my-auto d-flex justify-content-center justify-content-md-end ">
                    <button class="btn btn-modifier" onclick="openModifier()">Modifier profil</button>
                    <a href="../account/deco.php" class="text-reset text-decoration-none"><button class="btn btn-deconnexion">Se déconnecter</button></a>
                </div>
            </div>
            <div class="col-11 infos mx-auto my-5 mt-md-0 ">
                <p class="titres">Gérer le site</p>
                <div class="row-3 d-flex flex-wrap justify-content-around my-5">
                    <a href="poView.php"><button class="btn btn-option m-2" style="font-size:1.2rem!important">Voir les profils</button></a>
                    <form method="POST" action="../pages/ContactPO.php" class="m-2">
                        <input type="hidden" name="sender" value="PO">
                        <button type="submit" class="btn btn-option" style="font-size:1.2rem!important">Contacter l'admin</button>
                    </form>

                </div>
                <div class="row-1 d-flex flex-wrap justify-content-around align-items-center">

                    <div class="m-2">
                        <a href="../pages/poInscrSupp.php?InscrSupp=inscription"><button id="btnInscr" class="btn btn-option btn-lg btn-sans-decoration btn-texte-blanc w-100" style="background-color:green!important">Demandes d'inscription (<?php echo $nbInscr; ?>)</button> </a>
                    </div>

                    <div class="m-2">
                        <a class="w-100" href="../pages/poInscrSupp.php?InscrSupp=suppression"><button id="btnSupp" class="btn btn-option btn-lg btn-sans-decoration btn-texte-blanc w-100" style="background-color:#dc3545">Demandes de suppression (<?php echo $nbSupp; ?>)</button> </a>
                    </div>

                </div>

            </div>

        </section>

        <?php include('../includes/footer.html'); ?>
    </div>

    </div>

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