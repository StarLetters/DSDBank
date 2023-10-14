<?php

if ( (!isset($_POST['email'])) || (!isset($_POST['password'])) || (!isset($_POST['numeroSiren'])) || (!isset($_POST['raisonSociale'])) || (!isset($_POST['telephone'])) ){
    echo "Erreur : données manquantes<br>";
    print_r($_POST['email']);


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
print_r($result);

    $request = "
    INSERT INTO users VALUES
    (NULL,
    '".$email."',
    '".$password."',
    '".$inscriptionDate."',
    ".$numeroSiren.",
    'cli',
    '".$raisonSociale."',
    '".$telephone."')
    ;";

    echo $request;

    $result = $cnx->prepare($request);
    $result->execute();



    $result->closeCursor();

?>