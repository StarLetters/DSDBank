<?php
session_start();

include('../account/verifLogin.php');
if  (verifLogin() != 2) {
    header('Location: ../pages/welcome.php');
}

// Si il manque une donnée dans le formulaire
if ( isset($_POST['email']) && isset($_POST['password']) && isset($_POST['siren']) && isset($_POST['socialReason']) && isset($_POST['phone']))
{
include('../backend/cnx.php');

// Données à insérer dans la base de données
$email = htmlspecialchars($_POST['email']);
$pwd = htmlspecialchars($_POST['password']);
$inscriptionDate = date("Y-m-d");
$siren = htmlspecialchars($_POST['siren']);
$socialReason = htmlspecialchars($_POST['socialReason']);
$phone = htmlspecialchars($_POST['phone']);

// Vérification de l'unicite de l'email
$request = 'SELECT email, mdp FROM Utilisateur WHERE email = :email';

    $result = $cnx->prepare($request);
    $result->bindParam(':email', $email);
    $result->execute();
    $result = $result->fetchAll();

    //SI YA DEJA QUELQU'UN AVEC CET EMAIL
    //TODO
    if (count($result) > 0) {
        echo "Cet email est déjà utilisé";
        exit;
    }

// Insertion des données d'utilisateur dans la base de données
$request = 
'INSERT INTO `Utilisateur` (`email`, `mdp`, `role`, `numTel`)
VALUES (:email, SHA2(:pwd, 256), "Client", :phone)
RETURNING idUtilisateur';
$result = $cnx->prepare($request);
$result->bindParam(':email', $email);
$result->bindParam(':pwd', $pwd);
$result->bindParam(':phone', $phone);
$result->execute();

$idUtilisateur = $result->fetchColumn();

// Insertion des données de client dans la base de données
$request = 
'INSERT INTO `Entreprise` (`idUtilisateur`, `numSiren`, `raisonSociale`)
VALUES (:idUtilisateur, :siren, :socialReason)';
$result = $cnx->prepare($request);
$result->bindParam(':idUtilisateur', $idUtilisateur);
$result->bindParam(':siren', $siren);
$result->bindParam(':socialReason', $socialReason);
$result->execute();

// Insertion des données de client dans la base de données
$request = 
'INSERT INTO `POrequete` (`email`, `type_requete`)
VALUES (:email, "inscription" )';
$result = $cnx->prepare($request);
$result->bindParam(':email', $email);
$result->execute();



$result->closeCursor(); 


include('../backend/mailer.php');
verification($socialReason, $email);
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/Register.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/varColor.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="../scripts/load.js"></script>
    <script defer src="../scripts/passwordMatch.js"></script>
</head>

<body>
    <div class="center-box">
        <div class="border-head">
            <h1>Inscription</h1>
        </div>


        <form method="POST" action="createAccount.php" class="registration-form mt-4 needs-validation" id="registration-form" novalidate>
            <div class="form-row">
                <div class="form-group col-md-6 mb-4"> <!-- Colonne de largeur 6 pour Raison Sociale -->
                    <label for="socialReason">Raison Sociale</label>
                    <input class="form-control" type="text" id="socialReason" name="socialReason" placeholder="Raison Sociale" maxlength="100" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="form-group col-md-6 mb-4"> <!-- Colonne de largeur 6 pour Raison Sociale -->
                    <label for="siren">N° SIREN</label>
                    <input class="form-control" type="text" id="siren" name="siren" placeholder="Numéro SIREN" pattern="[0-9]{9}" maxlength="9" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="form-group col-md-6 mb-4"> <!-- Colonne de largeur 6 pour Email -->
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="50" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="form-group col-md-6 mb-4"> <!-- Colonne de largeur 6 pour Téléphone --> <!-- PAS SUR POUR LE PATTERN -->
                    <label for="phone">Téléphone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Téléphone" maxlength="10" pattern="^\+?\d{7,10}$" />
                    <div class="invalid-feedback">Erreur</div>
                </div>
            </div>




            <div class="form-row">
                <div class="form-group col-md-6 mb-4">
                    <label for="password">Créer un mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Créer un mot de passe" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="form-group col-md-6 mb-4">
                    <label for="confirmPassword">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirmer le mot de passe" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" required />
                </div>
                <div class="invalid-feedback">Erreur</div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-12 text-center">
                    <!-- Bouton "S'inscrire" -->
                    <button type="submit" class="custom-button mr-3">
                        S'inscrire
                    </button>
                </div>
            </div>


            <!-- Bouton "Retour" -->
            <a href="javascript:history.back()" class="custom-button btn-secondary"><span class="arrow-left">&#x2190;</span> Retour</a>
        </form>
    </div>

</body>
</html>