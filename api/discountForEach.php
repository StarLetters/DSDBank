<?php
include('../backend/cnx.php');

include('../api/utilities.php');

function getDiscount($token, $role, $num, $nSIREN, $raisonSociale, $order, $startDate, $endDate)
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
    Utilisateur ON Utilisateur.idUtilisateur = Entreprise.idUtilisateur
  JOIN
    Remise ON Remise.numRemise = Transaction.numRemise
  WHERE Utilisateur.idUtilisateur = Entreprise.idUtilisateur";
  if ($role == 0) {
    $request .= " AND Transaction.idUtilisateur IN (
            SELECT DISTINCT tra.idUtilisateur
            FROM Transaction tra, Token tok, Utilisateur uti
            WHERE tra.idUtilisateur = uti.idUtilisateur
            AND uti.email = tok.email
            AND tok.token = :token)";
  } else {
    if ($nSIREN !== null) {
      $request .= " AND Entreprise.numSiren = :numSiren";
    }
    if ($raisonSociale !== null) {
      $request .= " AND Entreprise.raisonSociale = :raisonSociale";
    }
  }
  if ($num !== null) {
    $request .= " AND Transaction.numRemise = :numRemise";
  }
  if ($startDate !== null) {
    $request .= " AND dateRemise >= :startDate";
  }
  if ($endDate !== null) {
    $request .= " AND dateRemise <= :endDate";
  }
  $request .= " GROUP BY 
    Entreprise.numSiren, Entreprise.raisonSociale, Transaction.devise, Transaction.numRemise, dateRemise";

  // Ajout OrderBy
  if ($order !== null) {
    if ($order == "montantDesc") {
      $order = "`Montant total` desc";
    } else if ($order == "montantAsc") {
      $order = "`Montant total` asc";
    }
  } else {
    $order = "Transaction.numRemise asc";
  }
  $request .= " ORDER BY $order;";

  $result = $cnx->prepare($request);
  if ($role == 0) {
    $result->bindParam(":token", $token);
  }

  if ($num !== null) {
    $result->bindParam(":numRemise", $num);
  }

  if ($nSIREN !== null) {
    $result->bindParam(":numSiren", $nSIREN);
  }

  if ($raisonSociale !== null) {
    $result->bindParam(":raisonSociale", $raisonSociale);
  }

  if ($startDate !== null) {
    $result->bindParam(":startDate", $startDate);
  }

  if ($endDate !== null) {
    $result->bindParam(":endDate", $endDate);
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

$nSIREN = isset($_GET['nSiren']) ? htmlspecialchars($_GET['nSiren']) : null;
$nRemise = isset($_GET['nRemise']) ? htmlspecialchars($_GET['nRemise']) : null;
$raisonSociale = isset($_GET['raison']) ? htmlspecialchars($_GET['raison']) : null;

$order = isset($_GET['order']) ? htmlspecialchars($_GET['order']) : null;
$startDate = isset($_GET['startDate']) ? htmlspecialchars($_GET['startDate']) : null;
$endDate = isset($_GET['endDate']) ? htmlspecialchars($_GET['endDate']) : null;



$result = getDiscount($token, $role, $nRemise, $nSIREN, $raisonSociale, $order, $startDate, $endDate);
outputJson($result);
