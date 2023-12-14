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

    include('../backend/cnx.php');
    $requete = "SELECT * FROM Token WHERE email = '" . $email . "' AND token = '" . $token . "' AND type = 'verification';"; // On vérifie si le token existe
    $cnx->prepare($requete);
    $resultat = $cnx->query($requete);

    if($resultat->rowCount() == 0){ // Si le token n'existe pas
        echo "Erreur lors de la vérification";
        exit;
    }
    while ($donnees = $resultat->fetch()) {
        $date = $donnees['date_valid'];
        if ($date > date("Y-m-d H:i:s")) { // Si le token est valide
            $requete = "UPDATE Utilisateur SET verifier = 1 WHERE email = '" . $email . "';"; // On vérifie le compte
            $cnx->prepare($requete);
            $cnx->exec($requete);
            echo "Votre compte a été vérifié";
        } else {
            echo "Le lien a expiré";
        }
    }
    header('Location: deco.php');


    ?>
</body>

</html>