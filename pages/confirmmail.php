<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation</title>
    <link rel="stylesheet" href="../css/Confirm.css">
</head>

<body>
    <div class="outer-container">
        <div class="content-container">
            <div class="header">
                CONFIRMATION MAIL
            </div>
            <div class="content">
                <div class="center">
                    <img src="../data/img/LogoDSD.png">
                </div>
                <div class="message">
                    Bienvenue!
                </div>
                <div class="message">
                    Un mail de confirmation vient de vous être envoyé!
                </div>
                <div class="message">
                    Meilleures salutations,
                </div>
                <div class="message">
                    DSD Bank
                </div>
                <div class="center">
                    <div class="message">
                        Mail non reçu ?
                    </div>
                </div>
                <div class="center">
                    <form method="POST" action="../backend/mailer.php">
                        <input type="hidden" name="which" value="register" />
                        <input type="submit" value="Renvoyer le mail" class="button">
                    </form>
                </div>
                <div class="center top-left-button">
                    <a href="register.php" class="back-button">Retour</a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>