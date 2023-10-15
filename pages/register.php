<?php

if ( (!isset($_POST['email'])) || (!isset($_POST['password'])) || (!isset($_POST['numeroSiren'])) || (!isset($_POST['raisonSociale'])) || (!isset($_POST['telephone'])) ){
    echo "Erreur : données manquantes<br>";
    print_r($_POST);


    echo "<br><a href='../pages/register.php'>Retour</a>";
    exit;
}

include('../backend/cnx.php');

$email = $_POST['email'];
$password = $_POST['password'];
$inscriptionDate = date("Y-m-d");
$numeroSiren = $_POST['numeroSiren'];
$raisonSociale = $_POST['raisonSociale'];
$telephone = $_POST['telephone'];

$request = "
SELECT *
FROM dsd_users
WHERE email = $email";
$result = $cnx->prepare($request);
$result->execute();
$result = $result->fetchAll();

//SI YA DEJA QUELQU'UN AVEC CET EMAIL
//TODO
if (count($result) > 0){
    echo "Erreur : email déjà utilisé<br>";
}





print_r($result);

    $request = "
    INSERT INTO `dsd_users`(`email`, `password`, `numeroSiren`, `role`, `raisonSociale`, `telephone`) 
    VALUES
    (
    '".$email."',
    '".$password."',
    '".$inscriptionDate."',
    '".$numeroSiren.",'
    'Client',
    '".$raisonSociale."',
    '".$telephone."')
    ;";

    echo $request;

    $result = $cnx->prepare($request);
    $result->execute();



    $result->closeCursor();

?>