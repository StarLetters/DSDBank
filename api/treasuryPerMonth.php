<?php
// Pas autorisé ici
if (empty($_GET) || $_GET['token'] == "null") {
    header('Location: ../index.html');
    exit;
}

include('../backend/cnx.php');
include('../api/utilities.php');

$token = htmlspecialchars($_GET['token']);
$role = verifRole($token);

$request = "SELECT 
DATE_FORMAT(Transaction.dateVente, '%Y-%m') AS `mois`,
SUM(
  CASE 
    WHEN Transaction.sens = '-' THEN -Transaction.montant
    ELSE Transaction.montant
  END
) OVER (ORDER BY Transaction.dateVente) AS `totalmontant`
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
} else if (isset($_GET['nSIREN'])) {
    $request .= " WHERE Entreprise.numSiren = :numSiren";
}else{
    header('Location: ../index.html');
}
$request .= " GROUP BY DATE_FORMAT(Transaction.dateVente, '%Y-%m');";
$result = $cnx->prepare($request);
if ($role == 0) {
    $result->bindParam(":token", $token);
} else if (isset($_GET['nSIREN'])) {
    $result->bindParam(":numSiren", $_GET['nSIREN']);
}
$result->execute();
$result = $result->fetchAll();
outputJson($result);
?>
