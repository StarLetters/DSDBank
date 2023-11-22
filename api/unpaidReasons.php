<?php
// Pas autorisé ici
if (empty($_GET) || $_GET['token'] == "null"){
    header('Location: ../index.html');
    exit;
}

include('../backend/cnx.php');
$token = htmlspecialchars($_GET['token']);

$request = 
"SELECT libelleImpaye as libelle, count(libelleImpaye) as count 
FROM Impaye imp, Transaction tra 
WHERE imp.idTransaction = tra.idTransaction 
"; 

if (isset($_GET['leftBound'])){
    $request .= "AND t.dateVente >= '".htmlspecialchars($_GET['leftBound'])."' ";
}

if (isset($_GET['rightBound'])){
    $request .= "AND t.dateVente <= '".htmlspecialchars($_GET['rightBound'])."' ";
}

$request .= 
"AND t.idUtilisateur IN (
    SELECT DISTINCT tra.idUtilisateur
    FROM Transaction tra, Token tok, Utilisateur uti
    WHERE tra.idUtilisateur = uti.idUtilisateur
     AND uti.email = tok.email
    AND tok.token = :token)
    GROUP BY libelleImpaye;";

$result = $cnx->prepare($request);
$result->bindParam(":token", $token);
$result->execute();
$result = $result->fetchAll();

header('Content-Type: application/json');
echo json_encode($result);

?>