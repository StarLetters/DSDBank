<?php
// Pas autorisé ici
if (empty($_GET) || $_GET['token'] == "null") {
    header('Location: ../index.html');
    exit;
}

include('../backend/cnx.php');
include('../api/utilities.php');

$token = htmlspecialchars($_GET['token']);
$raisonSociale = isset($_GET['raisonSociale']) ? htmlspecialchars($_GET['raisonSociale']) : null;
$nSiren = isset($_GET['nSIREN']) ? htmlspecialchars($_GET['nSIREN']) : null;
$dateValeur = isset($_GET['rightBound']) ? htmlspecialchars($_GET['rightBound']) : null;
$dateDebut = isset($_GET['leftBound']) ? htmlspecialchars($_GET['leftBound']) : null;

$role = verifRole($token);

$request = "SELECT 
DATE_FORMAT(Transaction.dateVente, '%Y-%m') AS `mois`,
SUM(
  CASE 
    WHEN Transaction.sens = '-' THEN -Transaction.montant
    ELSE Transaction.montant
  END
) AS `totalmontant`
FROM 
Transaction
JOIN 
  Entreprise ON Entreprise.idUtilisateur = Transaction.idUtilisateur";
if ($role == 0) {
    $request .= " WHERE Transaction.idUtilisateur IN (
        SELECT DISTINCT tra.idUtilisateur
        FROM Transaction tra, Token tok, Utilisateur uti
        WHERE tra.idUtilisateur = uti.idUtilisateur
        AND uti.email = tok.email
        AND tok.token = :token)";
} else {
   if ($nSiren) $request .= " WHERE Entreprise.numSiren = '". $nSiren ."'";
   if ($raisonSociale) $request .= " AND Entreprise.raisonSociale = '". $raisonSociale ."'";
  }
  if ($dateDebut) $request .= " AND Transaction.dateVente >= '". $dateDebut ."'";
  if ($dateValeur) $request .= " AND Transaction.dateVente <= '". $dateValeur ."'" ;

$request .= " GROUP BY DATE_FORMAT(Transaction.dateVente, '%Y-%m');";
$result = $cnx->prepare($request);
if ($role == 0) $result->bindParam(":token", $token);

$result->execute();
$result = $result->fetchAll();
outputJson($result);
?>
