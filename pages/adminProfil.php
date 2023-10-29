<?php

session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 3) {
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

    <!-- TODO : Afficher les informations de l'admin -->

    <!-- TODO : Bouton modifier profil -> popup modifier mdp (href=demandereinit.html) -->
    <!-- TODO : deconnexion href='../account/deco.php' -->

    <!-- TODO : Bouton Inscription id="btnInscr"-->
    <!-- TODO : Bouton Suppression id="btnSupp" -->

    <?php
        // Code pour afficher le nombre de demandes d'inscription
        include('../backend/cnx.php');
        $request = "SELECT COUNT(*) FROM POrequete WHERE type_requete = 'inscription';";
        $result = $cnx->prepare($request);
        $result->execute();
        $result = $result->fetchAll();
        $nbInscr = $result[0][0];
        echo "<p> Il y a " . $nbInscr . " demandes d'inscription </p>";
    ?>
    
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

<script>
    var btnInscr = document.getElementById("btnInscr");
    var btnSupp = document.getElementById("btnSupp");
    // Script pour les boutons
    btnInscr.addEventListener("click", function() {
        <?php
            $_SESSION['InscrSupp'] = "inscription";
            header('Location: ../pages/adminInscrSupp.php')
            ?>
    });

    btnSupp.addEventListener("click", function() {
        <?php
            $_SESSION['InscrSupp'] = "suppression";
            header('Location: ../pages/adminInscrSupp.php')
            ?>
    });
</script>

</html>