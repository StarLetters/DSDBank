<?php

function verifLogin(){
    include('cnx.php');
    

    if (!isset($_SESSION['cnxToken']) || !isset($_SESSION['email'])) {
        header('Location: ../pages/welcome.php');
    }
    
    if (isset($_SESSION['cnxToken']) && isset($_SESSION['email'])) {
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
            case "lucas@gmail.com" : //ADMIN
                return 3; break;
            case "po@gmail.com" : //PRODUCT OWNER
                return 2; break;
            default : // CLIENT
                return 1; break; 
        }
    }


}
?>