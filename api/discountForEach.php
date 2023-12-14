<?php
include('../backend/cnx.php');

include('../api/utilities.php');

function getDiscount($token, $num, $filter)
{
    global $cnx;
    $request = "SELECT 
    Entreprise.numSiren AS `N° SIREN`, 
    Entreprise.raisonSociale AS `Raison sociale`,
    Transaction.numRemise AS `N° Remise`,
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
    else if ($num !== null && $filter !== null) {
      if ($filter == 0) {
        $request .= " WHERE Entreprise.numSiren = :numSiren";
      }
      else if ($filter == 1) {
        $request .= " WHERE Transaction.numRemise = :numRemise";
      }
    }
    $request .=" GROUP BY 
    Entreprise.numSiren, Entreprise.raisonSociale, Transaction.devise, Transaction.numRemise, dateRemise";
    $request .= " ORDER BY CONVERT(Transaction.numRemise, INTEGER) asc;";
    $result = $cnx->prepare($request);
    if ($token !== null) {
        $result->bindParam(":token", $token);
    }
    else if ($num !== null && $filter !== null) {
      if ($filter == 0) {
        $result->bindParam(":numSiren", $num);
      }
      else if ($filter == 1) {
        $result->bindParam(":numRemise", $num);
      }
    }
    $result->execute();
    $result = $result->fetchAll();
    return $result;
}


// Pas autorisé ici
if (empty($_GET) || $_GET['token'] == "null") {
  
    header('Location: ../index.html');
    exit;
}

$token = htmlspecialchars($_GET['token']);
$role = verifRole($token);
$num = null;
if ($role == 1 || $role == 0){
    if (isset($_GET['nSiren'])) {
        $num = htmlspecialchars($_GET['nSiren']);
        $filter = 0;
    } else {
        $num = isset($_GET['nRemise']) ? htmlspecialchars($_GET['nRemise']) : null;
        $filter = 1;
    }
    $token = null;
}
$result = getDiscount($token, $num, $filter);
outputJson($result);
?>