<?php
// Pas autorisé ici
if (empty($_GET) || $_GET['id'] == "null"){
    header('Location: ../index.html');
    exit;
    
}

include('../backend/cnx.php');
$id = htmlspecialchars($_GET['id']);


$request = 
"SELECT SUM(t.montant) as montant, month(t.dateVente) as mois, year(t.dateVente) as annee
FROM Transaction t, Impaye i
WHERE t.idTransaction = i.idTransaction 
"; 


if (isset($_GET['leftBound'])){
    $request .= "AND t.dateVente >= '".htmlspecialchars($_GET['leftBound'])."' ";
}

if (isset($_GET['rightBound'])){
    $request .= "AND t.dateVente <= '".htmlspecialchars($_GET['rightBound'])."' ";
}

if (isset($_GET['reason'])){
    $request .= "AND i.libelleImpaye = '".htmlspecialchars($_GET['reason'])."' ";
}

if (isset($_GET['number'])){
    $request .= "AND i.libelleImpaye = '".htmlspecialchars($_GET['reason'])."' ";
}

$request .= 
"AND t.idUtilisateur IN (
    SELECT DISTINCT tra.idUtilisateur
    FROM Transaction tra, Token tok, Utilisateur uti
    WHERE tra.idUtilisateur = uti.idUtilisateur
     AND uti.email = tok.email
    AND tok.token = :id)
    GROUP BY mois, annee
    ORDER BY annee, mois;";


$result = $cnx->prepare($request);
$result->bindParam(":id", $id);
$result->execute();
$result = $result->fetchAll();

header('Content-Type: application/json');
echo json_encode($result);

?>