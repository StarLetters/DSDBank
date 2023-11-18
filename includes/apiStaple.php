<?php

function getID($cnx){

if (!isset($_COOKIE['cnxToken'])) {
    header('Location: ../pages/adminHome.php');
}

//On prend l'id de l'utilisateur avec le token de connexion
$result = $cnx->prepare("SELECT idUtilisateur 
FROM Utilisateur u, Token t
WHERE u.email = t.email
AND t.token = :token;");
$result->bindParam(':token', $_COOKIE['cnxToken']);
$result->execute();
$result = $result->fetchAll();
return $result[0]['idUtilisateur'];

}
?>