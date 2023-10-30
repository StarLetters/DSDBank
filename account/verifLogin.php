<?php

function verifLogin(){
    include('../backend/cnx.php');
    	
    if (!isset($_SESSION['cnxToken']) || !isset($_SESSION['email'])) {
        header('Location: ../pages/welcome.php');
    }

    $email = $_SESSION['email'];
    $token = $_SESSION['cnxToken'];

    $request = "SELECT * FROM Token WHERE email = :email AND token = :token AND type = 'connexion';";
    $result = $cnx->prepare($request);
    $result->bindParam(':email', $email);
    $result->bindParam(':token', $token);
    $result->execute();
    $result = $result->fetchAll();
    if (empty($result)) {
        header('Location: ../pages/welcome.php');
        return 0;
    }
    
    switch ($email){
        case "elae.dsd@gmail.com" : //ADMIN
            return 2;
        case "po@gmail.com" : //PRODUCT OWNER
            return 1;
        default : // CLIENT
            return 0;      
    }


}
?>