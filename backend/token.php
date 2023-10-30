<?php

/*
    Fonction d'insertion du token dans la base de données
        Paramètres :
            - $email : email de l'utilisateur
            - $token : token de vérification
            - $type : type de token (connexion, inscription, réinitialisation)
    Retour :
        - rien
*/

function insertToken($email, $token, $type)
{
    include('cnx.php');
    $requete = "INSERT INTO Token (email, token, date_valid, type) VALUES (:email, :token, :date_valid, :type);";
    $stmt = $cnx->prepare($requete);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':token', $token);
    $date_valid = date("Y-m-d H:i:s", strtotime("+1 day"));
    $stmt->bindParam(':date_valid', $date_valid);
    $stmt->bindParam(':type', $type);
    $stmt->execute();
}

function newToken($email, $type){
    $string = sha1(rand());
    $token = substr($string, 0, 16); // Génération du token
    insertToken($email, $token, $type);
    return $token;
}

?>