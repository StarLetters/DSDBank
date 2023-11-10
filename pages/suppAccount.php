<?php
session_start();
include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 2) { // Si ce n'est pas un admin
    header('Location: ../pages/welcome.php');
}
include('../backend/cnx.php');
if ($cnx->inTransaction()) {
    $cnx->rollBack();
}
$cnx->beginTransaction();
$request = "SELECT * 
FROM Utilisateur
JOIN Entreprise ON Entreprise.idUtilisateur = Utilisateur.idUtilisateur
WHERE role = 'Client';";
$result = $cnx->prepare($request);
$result->execute();
$result = $result->fetchAll();
foreach ($result as $row) {
    $email = $row['email'];
    $email = str_replace(".", "_", $email);
    if (isset($_POST[$email]) && $_POST[$email] == "on") {
        // Supprimer les demandes d'inscription et ajouter les demandes de suppression
        $requete = "DELETE FROM POrequete WHERE email = '" . $row['email'] . "';";
        $cnx->exec($requete);
        $requete = "INSERT INTO POrequete (email, type_requete) VALUES ('" . $row['email'] . "', 'suppression');";
        $cnx->exec($requete);
    }
}

$cnx->commit();
header('Location: ../pages/adminView.php');
?>