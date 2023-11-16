<?php
include('../backend/cnx.php');

$request = "SELECT email FROM Utilisateur WHERE verifier=1;"; //On vérifie si l'utilisateur existe et si son compte est vérifié
$result = $cnx->prepare($request);
$result->execute();
$result = $result->fetchAll();

header('Content-Type: application/json');
echo json_encode($result);
?>