<?php
// Pas autorisé ici
if (empty($_GET) || $_GET['token'] == "null"){
    header('Location: ../index.html');
    exit;
}

include('../backend/cnx.php');
$token = htmlspecialchars($_GET['token']);
$po = false;

$request = "SELECT * FROM Token WHERE token = :token AND type = 'connexion';";
$result = $cnx->prepare($request);
$result->bindParam(':token', $token);
$result->execute();
$result = $result->fetchAll();
if ($result[0]['email'] == "po@gmail.com") {
    $po = true;
}

$request = 
"SELECT libelleImpaye as libelle, count(libelleImpaye) as count 
FROM Impaye imp, Transaction t, Entreprise e
WHERE imp.idTransaction = t.idTransaction 
AND e.idUtilisateur = t.idUtilisateur 
"; 

if (isset($_GET['leftBound'])){
    $request .= "AND t.dateVente >= '".htmlspecialchars($_GET['leftBound'])."' ";
}

if (isset($_GET['rightBound'])){
    $request .= "AND t.dateVente <= '".htmlspecialchars($_GET['rightBound'])."' ";
}

if ($po) {
    if (isset($_GET['nSIREN'])) {
        $request .= "AND e.numSiren = " . htmlspecialchars($_GET['nSIREN']) . " ";
    } else if (isset($_GET['raisonSociale'])) {
        $request .= "AND e.raisonSociale = '" . htmlspecialchars($_GET['raisonSociale']) . "' ";
    }
    $request .= "GROUP BY libelleImpaye;";
    $result = $cnx->prepare($request);
} else {
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
}

$result->execute();
$result = $result->fetchAll();

header('Content-Type: application/json');
echo json_encode($result);

?>