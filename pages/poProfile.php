<?php

session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 1) {
    header('Location: ../pages/welcome.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PO Profile</title>
</head>
<body>

    <!-- TODO : Afficher les informations du PO -->

    <!-- TODO : Bouton modifier profil -> popup modifier mdp (href=demandereinit.html) -->
    <!-- TODO : deconnexion href='../account/deco.php' -->

    <!-- TODO : Bouton Voir les profils href='poView.php'-->
    <!-- TODO : Bouton Contacter l'admin -->
    
</body>
</html>