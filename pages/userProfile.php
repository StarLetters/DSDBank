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
                <div class="vh-100">
                    
                </div>

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