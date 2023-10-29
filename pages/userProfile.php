<?php
session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role == 2) {
    header('Location: ../pages/poProfile.php');
}
else if ($role == 3) {
    header('Location: ../pages/adminHome.php');
}
else if ($role != 1) {
    header('Location: ../pages/welcome.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <!-- TODO : Afficher les informations de l'utilisateur -->

    <!-- TODO : Bouton modifier profil -> popup modifier mdp (href=demandereinit.html) -->
    <!-- TODO : deconnexion href='../account/deco.php' -->

    <?php

    ?>
</body>
</html>