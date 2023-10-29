<?php

    /* 
        Envoi du mail de reinitialisation 
    */
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    include('cnx.php');
    $requete = "SELECT raisonSociale FROM dsd_users WHERE email = '" . $email . "' AND verified=1;"; // On vérifie si l'utilisateur existe et si son compte est vérifié
    $cnx->prepare($requete);
    $result = $cnx->query($requete);
    if ($result->rowCount() == 0) {
        header('Location: ../account/confirmReinit.html');
        exit;
    }
    $donnees = $result->fetch();
    $socialReason = $donnees['raisonSociale'];
    include("mailer.php");
    forgot($socialReason);
}
