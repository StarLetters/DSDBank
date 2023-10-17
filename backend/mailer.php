<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'config.php';

require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';

/*
    Fonction d'envoi de mail
        Paramètres :
            - $name : nom de l'utilisateur
            - $email : email de l'utilisateur
            - $token : token de vérification
    Retour :
        - true si le mail a été envoyé
        - false si le mail n'a pas été envoyé
        
    */
function envoi_mail($name, $email, $subject, $body)
{

    $mail = new PHPMailer(true);

    try {
        //Paramètres du serveur SMTP
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_HOST;
        $mail->Password = SMTP_PASS;
        $mail->Port = 465;

        //Destinataire
        $mail->setFrom('elae.dsd@gmail.com', 'DSDBank');
        $mail->addAddress($email, $name);

        //Contenu du mail
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


/*
    Fonction d'insertion du token dans la base de données
        Paramètres :
            - $email : email de l'utilisateur
            - $token : token de vérification
    Retour :
        - rien
*/
function insertion($email, $token, $type)
{
    include('cnx.php');
    $requete = "INSERT INTO token (email, token, date_valid) VALUES ('" . $email . "', '" . $token . "', '" . date("Y-m-d H:i:s", strtotime("+1 day")) . "');";
    $cnx->prepare($requete);
    $cnx->exec($requete);
}

/*
    Fonction de vérification de l'adresse mail
    Retour :
        - true si l'adresse mail a été vérifiée
        - false si l'adresse mail n'a pas été vérifiée
*/

function verification()
{
    if ((isset($_POST['socialReason']) && isset($_POST['email'])) || (isset($_SESSION['email']) && isset($_SESSION['token']) && isset($_SESSION['socialReason']))) {
        if (isset($_SESSION['email']) && isset($_SESSION['token']) && isset($_SESSION['socialReason'])) {
            $email = $_SESSION['email'];
            $token = $_SESSION['token'];
            $socialReason = $_SESSION['socialReason'];
        } else {
            $socialReason = $_POST['socialReason'];
            $email = $_POST['email'];
            $string = sha1(rand());
            $token = substr($string, 0, 16); // Génération du token
            $_SESSION['email'] = $email;
            $_SESSION['token'] = $token;
            $_SESSION['socialReason'] = $socialReason;
        }

        $subject = "Verification de votre adresse mail";

        $body = "<h1> DSDBank </h1>";
        $body .= "Bonjour " . $socialReason . ",";
        $body .= "<br><br>";
        $body .= "Il ne vous reste qu'une étape pour vérifier votre nouvelle adresse e-mail.";
        $body .= "<br><br>";
        $body .= "Veuillez cliquer sur ce lien : <a href='" . VERIF_SITE . "?email=" . $email . "&token=" . $token . "'>Cliquer ici</a>";
        $body .= "<br><br>";
        $body .= "Si vous n'avez pas demandé à vérifier cette adresse e-mail, vous pouvez ignorer cet e-mail.";
        $body .= "<br><br>";
        $body .= "Merci,";
        $body .= "<br>";
        $body .= "L'équipe DSDBank";

        if (envoi_mail($socialReason, $email, $subject, $body)) {
            //echo 'OK';
            insertion($email, $token, "verification");
            header('Location: ../pages/confirmmail.php');
            exit();
        } else {
            echo "Une erreur s'est produite";
        }
    } else {
        //test_mail("lucas", "houangkeo@gmail.com", $token);
        header('Location: ../pages/register.php');
    }
}

/* 
    Fonction d'envoi de mail de connexion
    Retour :
        - true si le mail a été envoyé
        - false si le mail n'a pas été envoyé
*/

function login()
{
    if (isset($_SESSION['email']) && isset($_SESSION['socialReason'])) {
        $email = $_SESSION['email'];
        $socialReason = $_SESSION['socialReason'];
    }
    $subject = "Connexion à votre compte";
    $body = "<h1> DSDBank </h1>";
    $body .= "Bonjour " . $socialReason . ",";
    $body .= "<br><br>";
    $body .= "Vous venez de vous connecter à votre compte.";
    $body .= "<br><br>";
    $body .= "Si vous n'avez pas demandé à vous connecter à votre compte, veuillez nous contacter.";
    $body .= "<br><br>";
    $body .= "Merci,";
    $body .= "<br>";
    $body .= "L'équipe DSDBank";

    envoi_mail($socialReason, $email, $subject, $body);
}

/*
    Fonction de réinitialisation du mot de passe
    Retour :
        - true si le mail a été envoyé
        - false si le mail n'a pas été envoyé
*/
function forgot($socialReason)
{
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $string = sha1(rand());
        $token = substr($string, 0, 16); // Génération du token

        $subject = "Réinitialisation de votre mot de passe";
        $body = "<h1> DSDBank </h1>";
        $body .= "<br><br>";
        $body .= "Pour réinitialiser votre mot de passe, veuillez cliquer sur ce lien." . "<a href='" . VERIF_SITE . "?email=" . $email . "&token=" . $token . "'>Cliquer ici</a>";

        $body .= "<br><br>";
        $body .= "Si vous n'avez pas demandé à réinitialiser votre mot de passe, veuillez nous contacter.";
        $body .= "<br><br>";
        $body .= "Merci,";
        $body .= "<br>";
        $body .= "L'équipe DSDBank";

        if (envoi_mail($socialReason, $email, $subject, $body)) {
            //echo 'OK';
            insertion($email, $token, "reinitialisation");
            header('Location: ../pages/confirmreinit.html');
            exit();
        } else {
            echo "Une erreur s'est produite";
            header('Location:../pages/welcome.php');
        }
    }
}


/*
    Permet de décider quel mail sera envoyé en fonction de la valeur de $_POST['which']
*/ 
if (isset($_POST['which'])) {
    $which = $_POST['which'];
    switch ($which) {
        case 'register':
            verification();
            break;
        case 'login':
            login();
            break;
        default:
            break;
    }
}
