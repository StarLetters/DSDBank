<?php

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
function envoi_mail($name, $email, $token)
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
        $mail->Subject = "Verification de votre adresse mail";

        $mail->Body = "<h1> DSDBank </h1>";
        $mail->Body .= "Bonjour " . $name . ",";
        $mail->Body .= "<br><br>";
        $mail->Body .= "Il ne vous reste qu'une étape pour vérifier votre nouvelle adresse e-mail.";
        $mail->Body .= "<br><br>";
        $mail->Body .= "Veuillez cliquer sur ce lien : <a href='" . SITE_NAME . "?email=" . $email . "&token=" . $token . "'>Cliquer ici</a>";
        $mail->Body .= "<br><br>";
        $mail->Body .= "Si vous n'avez pas demandé à vérifier cette adresse e-mail, vous pouvez ignorer cet e-mail.";
        $mail->Body .= "<br><br>";
        $mail->Body .= "Merci,";
        $mail->Body .= "<br>";
        $mail->Body .= "L'équipe DSDBank";
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

/*
    Fonction de test d'envoi de mail
        Paramètres :
            - $name : nom de l'utilisateur
            - $email : email de l'utilisateur
            - $token : token de vérification
    Retour :
        - rien
*/
function test_mail($name, $email, $token)
{
    envoi_mail($name, $email, $token);
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

if (isset($_POST['nom']) && isset($_POST['email'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $string = sha1(rand());
    $token = substr($string, 0, 16); // Génération du token

    if (envoi_mail($nom, $email, $token)) {
        //echo 'OK';
        insertion($email, $token);
        header('Location: ../pages/confirmmail.php');
        exit();
    } else {
        echo "Une erreur s'est produite";
    }
} else {
    //test_mail("lucas", "houangkeo@gmail.com", $token);
    echo "non";
}
