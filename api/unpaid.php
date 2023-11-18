<?php

include('../backend/cnx.php');


$request = 
"SELECT t.montant, t.dateVente
FROM Transaction t, Impaye i
WHERE t.idTransaction = i.idTransaction "; //On vérifie si l'utilisateur existe et si son compte est vérifié

$id = htmlspecialchars($_GET['id']);

if (isset($_GET['leftBound'])){
    $request .= "AND dateVente >= '".htmlspecialchars($_GET['leftBound'])."'";
}

if (isset($_GET['rightBound'])){
    $request .= "AND dateVente <= '".htmlspecialchars($_GET['rightBound'])."'";
}

$request .= " ORDER BY dateVente ASC;";
$result = $cnx->prepare($request);
$result->execute();
$result = $result->fetchAll();

header('Content-Type: application/json');
echo json_encode($result);

?>