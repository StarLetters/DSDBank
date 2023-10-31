<?php

session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 2) { // Si ce n'est pas un admin
    header('Location: ../pages/welcome.php');
}

if (isset($_SESSION['InscrSupp'])){
    $inscrsupp = $_SESSION['InscrSupp']; // Inscription ou Suppression
}
else {
    header('Location: ../pages/adminProfile.php');
}

include('../backend/cnx.php');
$request = "SELECT * 
        FROM POrequete
        JOIN Utilisateur ON Utilisateur.email = POrequete.email
        WHERE type_requete = '".$inscrsupp."';";
$result = $cnx->prepare($request);
$result->execute();
$result = $result->fetchAll();

$cnx->beginTransaction();

foreach ($result as $row) {
    if (isset($_POST[$row['numSiren']])) {
        $requete = "DELETE FROM POrequete WHERE email = '" . $row['email'] . "';"; // Supprimer la demande
        $cnx->exec($requete);
        if (($inscrsupp == "suppression" && $_POST[$row['numSiren']] == "validate")|| ($inscrsupp == "inscription" && $_POST[$row['numSiren']] == "delete")){
            $requete = "DELETE FROM Entreprise WHERE idUtilisateur = '" . $row['idUtilisateur'] . "';";
            $cnx->exec($requete);
            $requete = "DELETE FROM Utilisateur WHERE idUtilisateur = '" . $row['idUtilisateur'] . "';";
            $cnx->exec($requete);
        }
    }
}

$cnx->commit();
header('Location: ../pages/adminProfile.php')
?>
