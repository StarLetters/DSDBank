<?php 
session_start();



if ( (!isset($_POST['email'])) || (!isset($_POST['password']))) {

    echo "Oula il manque un truc là";
} else {
    
    include('../backend/cnx.php');

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $request = 
    "SELECT * 
    FROM dsd_users
    WHERE email = '$email';";

    $result = $cnx->prepare($request);
    $result->execute();
    $result = $result->fetchAll();

    if ( empty($result) ){
        echo "L'utilisateur ou le mot de passe est incorrect";
    } 
    

    if (isPasswordValid($password,$result[0]['password'])){
        $_SESSION['email'] = $email;
        print_r($_SESSION);
    } else {
        echo "L'utilisateur ou le mot de passe est incorrect";
    }
} 

function isPasswordValid($password,$hash){
    return (hash('sha256',$password) == $hash);
}

?>