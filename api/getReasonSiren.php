<?php

include('../backend/cnx.php');

include('../api/utilities.php');

if (empty($_GET) || $_GET['token'] == "null") {
    header('Location: ' . $location);
    exit;
}

$token = htmlspecialchars($_GET['token']);
$role = verifRole($token);
$nSIREN = isset($_GET['numSiren']) ? htmlspecialchars($_GET['numSiren']) : null;
$raisonSociale = isset($_GET['raisonSociale']) ? htmlspecialchars($_GET['raisonSociale']) : null;

if ($role == 1) {
    if ($nSIREN !== null) {
        $request = "SELECT raisonSociale FROM Entreprise WHERE numSiren = :nSIREN;";
        $result = $cnx->prepare($request);
        $result->bindParam(':nSIREN', $nSIREN);
        $result->execute();
        $result = $result->fetch();
        outputJson($result);
    } else if ($raisonSociale !== null) {
        $request = "SELECT numSiren FROM Entreprise WHERE raisonSociale = :raisonSociale;";
        $result = $cnx->prepare($request);
        $result->bindParam(':raisonSociale', $raisonSociale);
        $result->execute();
        $result = $result->fetch();
        outputJson($result);
    }
} else {
    outputJson("Vous n'avez pas les droits pour accéder à cette page");
}
?>