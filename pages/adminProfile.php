<?php

session_start();

require('../account/verifLogin.php');
$verif = verifLogin();	
if ($verif != 2){
    header('Location: ../pages/welcome.php');
}

include('../backend/cnx.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PO Profile</title>
</head>
<body>

    <!-- TODO : Afficher les informations de l'admin -->

    <!-- TODO : Bouton modifier profil -> popup modifier mdp (href=demandereinit.html) -->
    <!-- TODO : deconnexion href='../account/deco.php' -->

    <button id="btnInscr"> <a href="../pages/adminInscrSupp.php?InscrSupp=inscription">Demandes d'inscription</a></button>
    <?php
        // Code pour afficher le nombre de demandes d'inscription
        $request = "SELECT COUNT(*) FROM POrequete WHERE type_requete = 'inscription';";
        $result = $cnx->prepare($request);
        $result->execute();
        $result = $result->fetchAll();
        $nbInscr = $result[0][0];
        echo "<p> Il y a " . $nbInscr . " demandes d'inscription </p>";
    ?>
    
    <br>

    <button id="btnSupp"> <a href="../pages/adminInscrSupp.php?InscrSupp=suppression">Demandes de suppression</a></button>

    <?php
        // Code pour afficher le nombre de demandes de suppressions
        $request = "SELECT COUNT(*) FROM POrequete WHERE type_requete = 'suppression';";
        $result = $cnx->prepare($request);
        $result->execute();
        $result = $result->fetchAll();
        $nbSupp = $result[0][0];
        echo "<p> Il y a " . $nbSupp . " demandes de suppression </p>";
    ?>


    
</body>

</html>
