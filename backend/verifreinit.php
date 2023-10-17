<?php   
if (!isset($_GET['email']) || !isset($_GET['token'])) {
    echo "Erreur lors de la vérification";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification mail</title>
</head>

<body>
    <?php
    $email = $_GET['email'];
    $token = $_GET['token'];

    include('cnx.php');
    $requete = "SELECT * FROM token WHERE email = '" . $email . "' AND token = '" . $token . "' AND type = 'verification';";
    $cnx->prepare($requete);
    $resultat = $cnx->query($requete);

    if($resultat->rowCount() == 0){
        echo "Erreur lors de la vérification";
        exit;
    }
    while ($donnees = $reponse->fetch()) {
        $date = $donnees['date_valid'];
        if ($date > date("Y-m-d H:i:s")) {
            $requete = "UPDATE users SET verified = 1 WHERE email = " . $email . ";";
            $cnx->prepare($requete);
            $cnx->exec($requete);
            echo "Votre compte a été vérifié";
        } else {
            echo "Le lien a expiré";
        }
    }

    ?>
</body>

</html>