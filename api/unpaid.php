<?php
// Pas autorisé ici
if (empty($_GET)){
    header('Location: ../index.html');
    
}

include('../backend/cnx.php');


$request = 
"SELECT t.montant, t.dateVente
FROM Transaction t, Impaye i
WHERE t.idTransaction = i.idTransaction
AND t.idUtilisateur = 35 
AND t.idUtilisateur IN (
SELECT DISTINCT tra.idUtilisateur
FROM Transaction tra, Token tok, Utilisateur uti
WHERE tra.idUtilisateur = uti.idUtilisateur 
AND uti.email = tok.email 
AND tok.token = :id) "; //On vérifie si l'utilisateur existe et si son compte est vérifié

$id = htmlspecialchars($_GET['id']);

if (isset($_GET['leftBound'])){
    $request .= "AND dateVente >= '".htmlspecialchars($_GET['leftBound'])."' ";
}

if (isset($_GET['rightBound'])){
    $request .= "AND dateVente <= '".htmlspecialchars($_GET['rightBound'])."' ";
}




$request .= " ORDER BY dateVente ASC;";
$result = $cnx->prepare($request);
$result->bindParam(":id", $id);
$result->execute();
$result = $result->fetchAll();

header('Content-Type: application/json');
echo json_encode($result);

?>