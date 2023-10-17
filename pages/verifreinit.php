<?php
session_start();
// Si on vient de l'url avec un token
if (isset($_GET['email']) && isset($_GET['token'])) {
    include('../backend/cnx.php');

    $email = htmlspecialchars($_GET['email']);
    $token = htmlspecialchars($_GET['token']);

    // On vérifie la validité du token
    $requete = 'SELECT * FROM token WHERE email = :email AND token = :token AND type = "reinitialisation" AND etat != "used" ;';
    $result = $cnx->prepare($requete);
    $result->bindParam(':email', $email);
    $result->bindParam(':token', $token);
    $result->execute();

    if ($result->rowCount() == 0) {
        echo "Erreur lors de la reinitialisation";
        exit;
    }
    // On enregistre l'id du token
    $idToken = $result->fetch()['idToken'];

    // On met le token à on
    $requete = 'UPDATE token SET etat = "on" WHERE idToken = :idToken;';
    $result = $cnx->prepare($requete);
    $result->bindParam(':idToken', $idToken);
    $result->execute();
}
// Sinon, on vient de remplir le formulaire
else {
    if (isset($_POST['password']) && isset($_POST['idToken'])) {
        include('../backend/cnx.php');
        $idToken = htmlspecialchars($_POST['idToken']);
        $password = htmlspecialchars($_POST['password']);

        // On vérifie que le token est bien à on pour que ce soit bien l'utilisateur qui a demandé la réinitialisation
        $requete = 'SELECT * FROM token WHERE idToken = :idToken AND etat = "on" ;';
        $result = $cnx->prepare($requete);
        $result->bindParam(':idToken', $idToken);
        $result->execute();

        if ($result->rowCount() == 0) {
            echo "Vous n'êtes pas autorisé ici";
            exit;
        }

        $email = $result->fetch()['email'];

        //Modification du mot de passe dans la base de données
        $request = "UPDATE dsd_users SET password = SHA2(:password, 256) WHERE email = :email;";
        $result = $cnx->prepare($request);
        $result->bindParam(':email', $email);
        $result->bindParam(':password', $password);
        $result->execute();

        // On met le token à used
        $request = 'UPDATE token SET etat = "used" WHERE idToken = :idToken;';
        $result = $cnx->prepare($request);
        $result->bindParam(':idToken', $idToken);
        $result->execute();
        echo "Votre mot de passe a été modifié";
        exit;
    }

    echo "Vous n'êtes pas autorisé ici";
    echo $_SESSION['email'];
    exit;
}

include('../includes/head.html');
?>


<body>
    <div class="center-box">
        <div class="border-head">
            <h1>Réinitialisation du mot de passe</h1>
        </div>

        <form method="POST" action="verifreinit.php" class="registration-form mt-4 needs-validation" novalidate>

            <div class="form-row" style="justify-content: center; margin:2vw">
                <div class="form-group col-md-6 mb-4">
                    <label for="password">Créer un nouveau mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Créer un mot de passe" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*\W).{12,}$" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="invalid-feedback">Erreur</div>
            </div>

            <input type='hidden' name='idToken' value=<?php echo $idToken ?>>
            <div class="form-row">
                <div class="form-group col-md-12 text-center">
                    <!-- Bouton "S'inscrire" -->
                    <button type="submit" class="custom-button mr-3">
                        S'inscrire
                    </button>
                    <!-- Bouton "Retour" -->

                </div>
            </div>
        </form>
    </div>
</body>

</html>