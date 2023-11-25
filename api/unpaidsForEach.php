<?php
// Pas autorisé ici
if (empty($_GET) || $_GET['token'] == "null") {
    header('Location: ../index.html');
    exit;
}

include('../backend/cnx.php');
$token = htmlspecialchars($_GET['token']);

$request =
    "SELECT Entreprise.numSiren as N°SIREN, Transaction.dateVente, IFNULL(Remise.dateRemise,'" . "Pas encore" . "') as dateRemise, ClientFinal.numCarteClient as N°Carte, ClientFinal.reseauClient, Impaye.numDossierImpaye as N°DossierImpaye, Transaction.devise, Transaction.montant, Transaction.sens, Impaye.libelleImpaye FROM Impaye
LEFT JOIN Transaction ON Impaye.idTransaction = Transaction.idTransaction
LEFT JOIN Utilisateur ON Utilisateur.idUtilisateur = Transaction.idUtilisateur
LEFT JOIN ClientFinal ON ClientFinal.idClient = Transaction.idClient
LEFT JOIN Entreprise ON Entreprise.idUtilisateur = Transaction.idUtilisateur
LEFT JOIN Remise ON Remise.numRemise = Transaction.numRemise
WHERE Transaction.idUtilisateur IN (
    SELECT DISTINCT tra.idUtilisateur
    FROM Transaction tra, Token tok, Utilisateur uti
    WHERE tra.idUtilisateur = uti.idUtilisateur
    AND uti.email = tok.email
    AND tok.token = :token) ";

if (isset($_GET['nImp'])) {
    $request .= "AND Impaye.numDossierImpaye = '" . htmlspecialchars($_GET['nImp']) . "' ";
}

if (isset($_GET['leftBound'])) {
    $request .= "AND Transaction.dateVente >= '" . htmlspecialchars($_GET['leftBound']) . "' ";
}

if (isset($_GET['rightBound'])) {
    $request .= "AND Transaction.dateVente <= '" . htmlspecialchars($_GET['rightBound']) . "' ";
}


if (isset($_GET['orderby'])) {
    $request .=
        "ORDER BY ";
    $request .= htmlspecialchars($_GET['orderby']);
}

$request .= ";";

$result = $cnx->prepare($request);
$result->bindParam(":token", $token);
$result->execute();
$result = $result->fetchAll();

header('Content-Type: application/json');
echo json_encode($result);
