<?php    
    if (isset($_POST['email'])){
    $email = $_POST['email'];
    include('cnx.php');
    $requete = "SELECT raisonSociale FROM dsd_users WHERE email = '" . $email . "';";
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
?>