<?php
include('../backend/cnx.php');

include('../api/utilities.php');

function getDiscount($token, $numRemise)
{
    global $cnx;
    $request = "SELECT 
    Entreprise.numSiren AS `N°SIREN`, 
    Entreprise.raisonSociale AS `Raison sociale`,
    Transaction.numRemise AS `N°Remise`,
    dateRemise AS `Date de traitement`,
    COUNT(*) AS `Nombre de remises`,
    Transaction.devise,
    SUM(
      CASE 
        WHEN Transaction.sens = '-' THEN -Transaction.montant
        ELSE Transaction.montant
      END
    ) AS `Montant total`
  FROM 
    Transaction 
  JOIN 
    Entreprise ON Entreprise.idUtilisateur = Transaction.idUtilisateur
  JOIN
    Remise ON Remise.numRemise = Transaction.numRemise";
    if ($token !== null) {
        $request .= " WHERE Transaction.idUtilisateur IN (
            SELECT DISTINCT tra.idUtilisateur
            FROM Transaction tra, Token tok, Utilisateur uti
            WHERE tra.idUtilisateur = uti.idUtilisateur
            AND uti.email = tok.email
            AND tok.token = :token)";
    }
    else if ($numRemise !== null) {
        $request .= " WHERE Transaction.numRemise = :numRemise";
    }
    $request .=" GROUP BY 
    Entreprise.numSiren, Entreprise.raisonSociale, Transaction.devise, Transaction.numRemise, dateRemise";
    $request .= " ORDER BY CONVERT(Transaction.numRemise, INTEGER) asc;";
    $result = $cnx->prepare($request);
    if ($token !== null) {
        $result->bindParam(":token", $token);
    }
    else if ($numRemise !== null) {
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
$numRemise = null;
if ($role == 1){
    $numRemise = isset($_GET['nRemise']) ? htmlspecialchars($_GET['nRemise']) : null;
    $token = null;
}
$result = getDiscount($token, $numRemise);
outputJson($result);
?>