<?php
session_start();

/* Fonction qui vérifie si le mot de passe est correct */
function isPasswordValid($password, $hash)
{
    return (hash('sha256', $password) == $hash);
}

if (isset($_SESSION['email'])) { // Si l'utilisateur est déjà connecté
    header('Location: home.php');
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>DSD Bank</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="shortcut icon" href="../data/img/LogoDSD.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel='stylesheet' type='text/css' media='screen' href='../css/Welcome.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/varColor.css'>
    <link rel="stylesheet" type="text/css" media="screen" href="../css/global.css" />

    <script src="../scripts/Eye.js"></script>
    <script src="../scripts/load.js"></script>
</head>

<body>
    <div class="center-box">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 left-content">
                    <img src="../data/img/LogoDSD.png" alt="DSD BANK Logo">
                    <h2 class="mt-5">DSD BANK</h2>

                    <h4>Vous n'avez pas de compte ?</h4>
                    <a class="button-register" href="ContactPO.php">Contacter le responsable</a>
                </div>
                <div class="col-md-12 col-sm-12 mr-5 right-content">
                    <h1>Bienvenue,</h1>
                    <p>Saisissez vos informations pour vous connecter</p>
                    <?php

                    if (isset($_POST['email']) && isset($_POST['password'])) { // Si l'utilisateur a rempli le formulaire

                        include('../backend/cnx.php');

                        $email = $_POST['email'];
                        $password = $_POST['password'];


                        $request = "SELECT * FROM Utilisateur 
                        LEFT JOIN Entreprise ON Utilisateur.idUtilisateur = Entreprise.idUtilisateur 
                        WHERE email = '" . $email . "'  AND Utilisateur.verifier=1;";  // On vérifie si l'utilisateur existe et si son compte est vérifié
                        $result = $cnx->prepare($request);
                        $result->execute();
                        $result = $result->fetchAll();

                        if ((!empty($result)) && (isPasswordValid($password, $result[0]['mdp']))) {
                            $numSiren = $result[0]['numSiren'];
                            $id = $result[0]['idUtilisateur'];
                            $request = "SELECT * FROM POrequete WHERE email = '" . $email . "';"; // On vérifie si l'utilisateur est dans la table POrequest
                            $result = $cnx->prepare($request);
                            $result->execute();
                            $result = $result->fetchAll();
                            if (!empty($result)) {
                                echo "<p class='avertissement'>";
                                echo "Veuillez contacter le responsable"; // On affiche un message d'erreur
                                echo "</p>";
                                exit;
                            }
                            $_SESSION['email'] = $email;
                            if ($numSiren !== null) {
                                $_SESSION['numSiren'] = $numSiren;
                            }
                            $_SESSION['tries'] = 0;
                            

                            // On récupère le nom de l'utilisateur
                            include('../account/getDisplayName.php');
                            $_SESSION['displayName'] = getDisplayName( $id, $cnx );

                            include('../backend/mailer.php');
                            login(); // On envoie un mail de connexion
                            header('Location: home.php');
                        } else {
                            if (isset($_SESSION['tries'])) {
                                if ($_SESSION['tries'] == 2) {
                                    echo "<p class='avertissement'>";
                                    echo "ATTENTION, il ne vous reste qu'une tentative de connexion";
                                    echo "</p>";
                                }
                                if ($_SESSION['tries'] >= 3) {
                                    echo "<p class='avertissement'>";
                                    echo "Vous avez atteint le nombre maximal de tentatives, pour continuer veuillez réinitialiser votre mot de passe ou contacter l'administrateur";
                                    echo "</p>";
                                    exit;
                                }
                            } else {
                                $_SESSION['tries'] = 0;
                            }
                            echo "<p class='avertissement'>";
                            echo "L'utilisateur ou le mot de passe est incorrect"; // On affiche un message d'erreur
                            echo "</p>";
                            $_SESSION['tries'] += 1;
                        }
                    }
                    ?>

                    <form class="login-form" method="POST" action="welcome.php">
                        <div class="form-group">
                            <input type="text" id="email" name="email" placeholder="E-mail" required>
                        </div>
                        <div class="form-group">
                            <div class="password-input">
                                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                                <span class="eye-icon" onclick="togglePasswordVisibility(this)">&#x1F441;</span>
                            </div>
                        </div>
                        <div class="form-group text-left col">
                            <a class="button-forgot" href="demandereinit.html">Mot de passe oublié ?</a>
                        </div>
                        <div class="form-group text-left">
                            <button class="button-reset" type="reset">Réinitialiser</button>
                            <button class="button-login" type="submit">Se connecter</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
    </div>
</body>

</html>