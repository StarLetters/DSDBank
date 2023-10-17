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

<body background="../data/img/imgachangersvp.jpg">
    <div class="container">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                        <tr>
                            <td class="header">
                                CONFIRMATION MAIL
                            </td>
                        </tr>
                        <tr>
                            <td class="content">
                                <!-- Table -->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td align="center">
                                            <img src="../data/img/LogoDSD.png">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="message">
                                            Bienvenue!
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="message">
                                            Un mail de confirmation vient de vous être envoyé!
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="message">
                                            Meilleures salutations,
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="message">
                                            DSD Bank
                                        </td>
                                    </tr>
                                    <tr class="center">
                                        <td class="message">
                                            Mail non reçu ?
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <form method="POST" action="../backend/mailer.php">
                                                <input type="hidden" name="which" value="register" />
                                                <input type="submit" value="Renvoyer le mail" class="button">
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <a href="Register.html" class="button">Retour</a>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>