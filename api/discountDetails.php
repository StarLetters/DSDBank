<?php
include('../backend/cnx.php');

include('../api/utilities.php');

function getDiscountDetails($token, $numRemise)
{
    global $cnx;
    $request = "SELECT 
    Entreprise.numSiren AS `N°SIREN`, 
    Transaction.dateVente AS `Date de vente`,
    ClientFinal.numCarteClient AS `N° Carte`,
    ClientFinal.reseauClient AS `Réseau`,
    Transaction.numAutorisation AS `N° autorisation`,
    Transaction.devise AS `Devise`,
    Transaction.montant AS `Montant`,
    Transaction.sens AS `Sens`
  FROM 
    Transaction 
  JOIN 
    Entreprise ON Entreprise.idUtilisateur = Transaction.idUtilisateur
  JOIN
    ClientFinal ON ClientFinal.idClient = Transaction.idClient";
    if ($token !== null) {
        $request .= " WHERE Transaction.idUtilisateur IN (
            SELECT DISTINCT tra.idUtilisateur
            FROM Transaction tra, Token tok, Utilisateur uti
            WHERE tra.idUtilisateur = uti.idUtilisateur
            AND uti.email = tok.email
            AND tok.token = :token)";
        if ($numRemise !== null) {
            $request .= " AND Transaction.numRemise = :numRemise";
        }
    }
    else if ($numRemise !== null) {
        $request .= " WHERE Transaction.numRemise = :numRemise";
    }
    $request .= " ORDER BY Transaction.dateVente asc;";
    $result = $cnx->prepare($request);
    if ($token !== null) {
        $result->bindParam(":token", $token);
    }
    if ($numRemise !== null) {
        $result->bindParam(":numRemise", $numRemise);
    }
    $result->execute();
    $result = $result->fetchAll();
    return $result;
}

// Pas autorisé ici
if (empty($_GET) || $_GET['token'] == "null") {
    header('Location: ' . $location);
    exit;
}

$token = htmlspecialchars($_GET['token']);
$role = verifRole($token);
$numRemise = isset($_GET['nRemise']) ? htmlspecialchars($_GET['nRemise']) : null;
if ($role == 1 || $role == 0){
    $token = null;
}
$result = getDiscountDetails($token, $numRemise);
outputJson($result);
?>