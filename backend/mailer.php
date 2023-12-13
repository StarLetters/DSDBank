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


include('token.php');

/*
    Fonction de vérification de l'adresse mail
    Retour :
        - true si l'adresse mail a été vérifiée
        - false si l'adresse mail n'a pas été vérifiée
*/

function verification($socialReason, $email)
{

    $string = sha1(rand());
    $token = substr($string, 0, 16); // Génération du token


    $host = $_SERVER['HTTP_HOST'];
    $cheminVerification = '/account/verifMail.php';
    $lienVerification = 'http://' . $host . $cheminVerification . '?token=' . $token;

    $subject = "Verification de votre adresse mail";

    $body = "<h1> DSDBank </h1>";
    $body .= "Bonjour " . $socialReason . ",";
    $body .= "<br><br>";
    $body .= "Il ne vous reste qu'une étape pour vérifier votre nouvelle adresse e-mail.";
    $body .= "<br><br>";

    $body .= "Veuillez cliquer sur ce lien : <a href='" .$lienVerification. "'>Cliquer ici</a>";

    $body .= "<br><br>";
    $body .= "Si vous n'avez pas demandé à vérifier cette adresse e-mail, vous pouvez ignorer cet e-mail.";
    $body .= "<br><br>";
    $body .= "Merci,";
    $body .= "<br>";
    $body .= "L'équipe DSDBank";

    if (envoi_mail($socialReason, $email, $subject, $body)) {
        //echo 'OK';
        insertToken($email, $token, "verification");
        header('Location: ../account/confirmMailSent.php');
        exit();
    } else {
        echo "Une erreur s'est produite";
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

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        if (isset($_SESSION['socialReason'])) {
            $socialReason = $_SESSION['socialReason'];
        } else {
            $socialReason = "Monsieur/Madame";
        }
    }
    $_SESSION['cnxToken'] = newToken($email, "connexion"); // On crée un token de connexion

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

        $host = $_SERVER['HTTP_HOST'] . str_replace('\\','',dirname($_SERVER['REQUEST_URI'],2));
        $cheminReinit = '/account/verifReinit.php';
        $lienReinit = 'http://' . $host . $cheminReinit . '?token=' . $token . '&email=' . $email;

        $subject = "Réinitialisation de votre mot de passe";
        $body = "<h1> DSDBank </h1>";
        $body .= "<br><br>";
        $body .= "Pour réinitialiser votre mot de passe, veuillez cliquer sur ce lien." . "<a href='" . $lienReinit . "'>Cliquer ici</a>";

        $body .= "<br><br>";
        $body .= "Si vous n'avez pas demandé à réinitialiser votre mot de passe, veuillez nous contacter.";
        $body .= "<br><br>";
        $body .= "Merci,";
        $body .= "<br>";
        $body .= "L'équipe DSDBank";

        if (envoi_mail($socialReason, $email, $subject, $body)) {
            //echo 'OK';
            insertToken($email, $token, "reinitialisation");
            header('Location: ../account/confirmMailSent.php');
            exit();
        } else {
            echo "Une erreur s'est produite";
            header('Location:../pages/welcome.php');
        }
    }
}

/* 
    Fonction de contact
    Retour :
        - true si le mail a été envoyé
        - false si le mail n'a pas été envoyé
*/
function contact()
{
    include('../backend/cnx.php');
    $request = "SELECT email FROM Utilisateur WHERE role = 'PO';";
    $result = $cnx->prepare($request);
    $result->execute();
    $result = $result->fetchAll();

    if (isset($_POST['sender'])) {
        $sender = "Product Owner de DSDBank";
        $recipient = "Admin";
        $email = SMTP_HOST;
        $emailsender = $result[0]['email'];
    } else {
        $sender = $_POST['name'];
        $recipient = "PO";
        $email = $result[0]['email'];
        $emailsender = $_POST['email'];
    }
    $subject = $_POST['subject'];
    $text = $_POST['text'];

    $body = "<h1> DSDBank </h1>";
    $body .= "<br><br>";
    $body .= "Vous avez reçu un message de la part de " . $sender . " (" . $emailsender . ") :";
    $body .= "<br><br>";
    $body .= $text;
    $body .= "<br><br>";
    $body .= "Merci,";
    $body .= "<br>";
    $body .= "L'équipe DSDBank";
    if (envoi_mail($recipient, $email, $subject, $body)) {
        echo 'OK';
        header('Location:../account/confirmMailSent.php');
        exit();
    } else {
        echo "Une erreur s'est produite";
        header('Location:../pages/welcome.php');
    }
}



/*
    Permet de décider quel mail sera envoyé en fonction de la valeur de $_POST['which']
*/
if (isset($_POST['which'])) {
    $which = $_POST['which'];
    switch ($which) {
        case 'login':
            login();
            break;
        case 'contact':
            contact();
            break;
        default:
            break;
    }
}
