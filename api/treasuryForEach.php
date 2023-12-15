<?php
include('../backend/cnx.php');

include('../api/utilities.php');

function getTreasury($token, $numSiren, $order, $raisonSociale, $dateValeur)
{
    global $cnx;
    $request = "SELECT 
    Entreprise.numSiren AS `N°SIREN`, 
    Entreprise.raisonSociale, 
    COUNT(*) AS `Nombre de transactions`,
    Transaction.devise,
    SUM(
      CASE 
        WHEN Transaction.sens = '-' THEN -Transaction.montant
        ELSE Transaction.montant
      END
    ) AS `Total des montants`
  FROM 
    Transaction 
  JOIN 
    Entreprise ON Entreprise.idUtilisateur = Transaction.idUtilisateur";
    if ($token !== null) {
        $request .= " WHERE Transaction.idUtilisateur IN (
            SELECT DISTINCT tra.idUtilisateur
            FROM Transaction tra, Token tok, Utilisateur uti
            WHERE tra.idUtilisateur = uti.idUtilisateur
            AND uti.email = tok.email
            AND tok.token = :token)";
    }
    else if ($numSiren !== null) {
        $request .= " WHERE Entreprise.numSiren = '".$numSiren."'";
    }
    if ($raisonSociale !== null) {
        $request .= " AND Entreprise.raisonSociale = '".$raisonSociale."'";
    }
    if ($dateValeur !== null) {
        $request .= " AND Transaction.dateVente <= '".$dateValeur."'";
    }
    $request .=" GROUP BY 
    Entreprise.numSiren, Entreprise.raisonSociale, Transaction.devise";
    if ($order !== null) {
        if ($order == "montantDesc") {
            $order = "`Total des montants` desc";
        } else if ($order == "montantAsc") {
            $order = "`Total des montants` asc";
        } else if ($order == "numSiren") {
            $order = "`N°SIREN` asc";
        }
        $request .= " ORDER BY $order";
    }
    $request .= ";";
    $result = $cnx->prepare($request);
    if ($token !== null) {
        $result->bindParam(":token", $token);
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
$order = isset($_GET['orderby']) ? htmlspecialchars($_GET['orderby']) : null;
$numSiren = null;
$raisonSociale = null;
$dateValeur = null;
if ($role == 1){
    $numSiren = isset($_GET['nSIREN']) ? htmlspecialchars($_GET['nSIREN']) : null;
    $token = null;

    $raisonSociale = isset($_GET['raisonSociale']) ? htmlspecialchars($_GET['raisonSociale']) : null;
    $dateValeur = isset($_GET['dateValeur']) ? htmlspecialchars($_GET['dateValeur']) : null;
}
$result = getTreasury($token, $numSiren, $order, $raisonSociale, $dateValeur);
outputJson($result);
?>