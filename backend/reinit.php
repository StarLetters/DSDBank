<?php

    /* 
        Envoi du mail de reinitialisation 
    */
if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    include('cnx.php');
    $requete = "SELECT raisonSociale FROM Utilisateur, Entreprise WHERE email = '" . $email . "' AND Utilisateur.verifier=1; AND Utilisateur.idUtilisateur = Entreprise.idUtilisateur"; // On vérifie si l'utilisateur existe et si son compte est vérifié
    $cnx->prepare($requete);
    $result = $cnx->query($requete);
    if ($result === false || $result->rowCount() == 0) {
        header('Location: ../account/confirmMailSent.html');
        exit;
    }
    $donnees = $result->fetch();
    $socialReason = $donnees['raisonSociale'];
    include("mailer.php");
    forgot($socialReason);
}
