<?php

session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 2 || !isset($_GET['InscrSupp'])) { // Si ce n'est pas un admin, ou qu'on ne vient pas de adminInscrSupp.php
    header('Location: ../pages/welcome.php');
}


$inscrsupp = htmlspecialchars($_GET['InscrSupp']);

$listeSiren = (explode('|', $_POST['listeSiren'])); // Liste de tous les sirens à traiter
$listeSiren = array_filter($listeSiren); // Supprimer les éléments vides

include('../backend/cnx.php');

$cnx->beginTransaction();
foreach ($listeSiren as $siren) {

    $action = substr($siren, 0, 1); // + ou -
    $siren = substr($siren, 1); // Numéro SIREN

    $requete = 
    "SELECT Utilisateur.idUtilisateur
    FROM Utilisateur
    JOIN Entreprise ON Entreprise.idUtilisateur = Utilisateur.idUtilisateur
    WHERE Entreprise.numSiren = '" . $siren . "';"; // Récupérer l'idUtilisateur de l'entreprise
    $result = $cnx->prepare($requete);
    $result->execute();

    $idUtilisateur = $result->fetch()[0];

    $requete = 
    "DELETE POrequete FROM POrequete
    JOIN Utilisateur ON POrequete.email = Utilisateur.email
    JOIN Entreprise ON Entreprise.idUtilisateur = Utilisateur.idUtilisateur
    WHERE Entreprise.numSiren = '" . $siren . "';"; // Supprimer la demande
    echo $requete;
    $cnx->exec($requete);

    if ($inscrsupp === 'inscription'){
        inscription($cnx, $action, $îd);
    }
    else {
        suppression($cnx, $action, $id);
    }
}
$cnx->commit();

header('Location: ../pages/adminHome.php');




function inscription($cnx, $action, $id){
    // Si l'inscription est validée, on dit que l'utilisateur est vérifié
    if ($action === "+"){
        $requete = 
        "UPDATE Utilisateur
        SET verifier = 1
        WHERE idUtilisateur = '" . $id . "';";
        $cnx->exec($requete);

        $requete =
        "UPDATE Entreprise
        SET verifier = 1
        WHERE idUtilisateur = '" . $id . "';";
        $cnx->exec($requete);

    }
    // Si l'inscription est refusée, on supprime l'utilisateur
    else{
        suppression($cnx, "+", $id);
    }
}

function suppression($cnx, $action, $id){
    // Si la suppression est validée, on supprime l'utilisateur
    if ($action === "+"){

        $requete =
        "DELETE FROM Entreprise
        WHERE idUtilisateur = '" . $id . "';";
        $cnx->exec($requete);

        $requete = 
        "DELETE FROM Utilisateur
        WHERE idUtilisateur = '" . $id . "';";
        $cnx->exec($requete);

        
    }
}



header('Location: ../pages/adminHome.php')
?>
