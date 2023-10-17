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
function insertion($email, $token)
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
    if ((isset($_POST['nom']) && isset($_POST['email'])) || (isset($_SESSION['email']) && isset($_SESSION['token']) && isset($_SESSION['nom']))) {
        if (isset($_SESSION['email']) && isset($_SESSION['token']) && isset($_SESSION['nom'])) {
            $email = $_SESSION['email'];
            $token = $_SESSION['token'];
            $nom = $_SESSION['nom'];
        } else {
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $string = sha1(rand());
            $token = substr($string, 0, 16); // Génération du token
            $_SESSION['email'] = $email;
            $_SESSION['token'] = $token;
            $_SESSION['nom'] = $nom;
        }

        $subject = "Verification de votre adresse mail";

        $body = "<h1> DSDBank </h1>";
        $body .= "Bonjour " . $nom . ",";
        $body .= "<br><br>";
        $body .= "Il ne vous reste qu'une étape pour vérifier votre nouvelle adresse e-mail.";
        $body .= "<br><br>";
        $body .= "Veuillez cliquer sur ce lien : <a href='" . SITE_NAME . "?email=" . $email . "&token=" . $token . "'>Cliquer ici</a>";
        $body .= "<br><br>";
        $body .= "Si vous n'avez pas demandé à vérifier cette adresse e-mail, vous pouvez ignorer cet e-mail.";
        $body .= "<br><br>";
        $body .= "Merci,";
        $body .= "<br>";
        $body .= "L'équipe DSDBank";

        if (envoi_mail($nom, $email, $subject, $body)) {
            //echo 'OK';
            insertion($email, $token);
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

