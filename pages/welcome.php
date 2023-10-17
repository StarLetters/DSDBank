<?php 
session_start();

if ( isset($_POST['email']) && !isset($_POST['password'])) {

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
        header('Location: home.php');
        print_r($_SESSION);
    } else {
        echo "L'utilisateur ou le mot de passe est incorrect";
    }
} 

function isPasswordValid($password,$hash){
    return (hash('sha256',$password) == $hash);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>DSD Bank</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel='stylesheet' type='text/css' media='screen' href='../css/Welcome.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/varColor.css'>
    <script src="../scripts/Eye.js"></script>
    <script src="../scripts/load.js"></script>
</head> 
<body>
    <div class="center-box">
        <div class="left-content">
            <img src="../data/img/LogoDSD.png" alt="DSD BANK Logo">
            <h2>DSD BANK</h2>
            <h4>Vous n'avez pas de compte ?</h4>
            <a class="button-register" href="register.php">S'inscrire</a>
        </div>
        <div class="right-content">
            <div class="right-top">
                <h1>Bienvenue,</h1>
                <p>Saisissez vos informations pour vous connecter</p>
            </div>
            <form class="login-form" method="POST" action="welcome.php">
                <div class="form-group">
                    <input type="text" id="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="form-group">
                    <div class="password-input">
                        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                        <span class="eye-icon" onclick="togglePasswordVisibility(this)">&#x1F441;</span> <!-- pour le eye -->
                    </div>
                </div>
                <button class="button-reset" type="reset">Réinitialiser</button>
                <button class="button-login" type="submit">Se connecter > </button>
                <a href="test.php">test inputs</a>
                
            </form>
        </div>
    </div>    
</body>
</html>