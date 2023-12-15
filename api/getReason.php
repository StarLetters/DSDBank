<?php

// On récupère la raison sociale de l'utilisateur

include('../backend/cnx.php');

include('../api/utilities.php');

function getReason($siren) {
    $req = $cnx->prepare(
    'SELECT Entreprise.raisonSociale as `raisonSociale`
    FROM Entreprise
    WHERE numSiren = :numSiren');

    $req->bindParam(':numSiren', $siren);
    $req->execute();
    $result = $req->fetch();
    $req->closeCursor();
    return $result['raisonSociale'];
}

$numSiren = isset($_GET['nSiren']) ? htmlspecialchars($_GET['nSiren']) : null;
$result = getReason($numSiren);
outputJson($result);


?>