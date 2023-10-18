<?php
session_start();
// Si il manque une donnée dans le formulaire
if ( (!isset($_POST['email'])) || (!isset($_POST['password'])) || (!isset($_POST['siren'])) || (!isset($_POST['socialReason'])) || (!isset($_POST['phone'])) ){
}
else {

include('../backend/cnx.php');

// Données à insérer dans la base de données
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$inscriptionDate = date("Y-m-d");
$siren = htmlspecialchars($_POST['siren']);
$socialReason = htmlspecialchars($_POST['socialReason']);
$phone = htmlspecialchars($_POST['phone']);
$cardNumber = htmlspecialchars($_POST['card']);
$expirationDate = htmlspecialchars($_POST['expireOnDay']) . '/' . htmlspecialchars($_POST['expireOnMonth']);
$cvv = htmlspecialchars($_POST['cvv']);

// Vérification de l'unicite de l'email
$request = 'SELECT email, password FROM dsd_users WHERE email = :email';

$result = $cnx->prepare($request);
$result->bindParam(':email', $email);
$result->execute();
$result = $result->fetchAll();

//SI YA DEJA QUELQU'UN AVEC CET EMAIL
//TODO
if (count($result) > 0){
    exit;
}

$request = 
'INSERT INTO `dsd_users` (`email`, `password`, `numeroSiren`, `role`, `raisonSociale`, `telephone`, `numeroCarte`, `dateExpiration`, `cvv`)
VALUES (:email, SHA2(:password, 256), :siren, "Client", :socialReason, :phone, :cardNumber, :expirationDate, :cvv )';

$result = $cnx->prepare($request);
$result->bindParam(':email', $email);
$result->bindParam(':password', $password);
$result->bindParam(':siren', $siren);
$result->bindParam(':socialReason', $socialReason);
$result->bindParam(':phone', $phone);
$result->bindParam(':cardNumber', $cardNumber);
$result->bindParam(':expirationDate', $expirationDate);
$result->bindParam(':cvv', $cvv);
$result->execute();

$result->closeCursor();
  
include('../backend/mailer.php');
verification();
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap"
        rel="stylesheet" />


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
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


        <form method="POST" action="register.php" class="registration-form mt-4 needs-validation" id="registration-form" novalidate>
            <div class="form-row">
                <div class="form-group col-md-6 mb-4"> <!-- Colonne de largeur 6 pour Raison Sociale -->
                    <label for="socialReason">Raison Sociale</label>
                    <input class="form-control" type="text" id="socialReason" name="socialReason" placeholder="Raison Sociale" maxlength="100" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="form-group col-md-6 mb-4"> <!-- Colonne de largeur 6 pour Raison Sociale -->
                    <label for="siren">N° SIREN</label>
                    <input class="form-control" type="text" id="siren" name="siren" placeholder="Numéro SIREN" pattern="[0-9]{9}" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="form-group col-md-6 mb-4"> <!-- Colonne de largeur 6 pour Email -->
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="form-group col-md-6 mb-4"> <!-- Colonne de largeur 6 pour Téléphone --> <!-- PAS SUR POUR LE PATTERN -->
                    <label for="phone">Téléphone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Téléphone" pattern="^\+?\d{7,10}$" />
                    <div class="invalid-feedback">Erreur</div>
                </div>
            </div>
            

            <hr style="border: 2px solid #252029; margin-top: 20px;">

            <div class="form-row">

                <div class="form-row">
                    <div class="form-group col-md-11 mb-4">
                        <label for="card">Numéro de carte bancaire</label>
                        <input type="text" class="form-control" id="card" name="card" placeholder="Numéro de carte" pattern="[0-9]{4}[\s-]?[0-9]{4}[\s-]?[0-9]{4}" required />
                        <div class="invalid-feedback">Erreur</div>
                    </div>
                    
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1 mb-4">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="000" pattern="[0-9]{3}" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="form-group col-md-1 mb-4">
                    <label for="expireOnDay">Expire le</label>
                    <input type="text" class="form-control" id="expireOnDay" name="expireOnDay" placeholder="jj" pattern="[1-9]|[12][0-9]|3[01]" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="form-group">
                    /
                </div>
                <div class="form-group col-md-1 mb-4">
                    <label for="expireOnMonth">&nbsp;</label>
                    <input type="text" class="form-control" id="expireOnMonth" name="expireOnMonth" placeholder="mm" pattern="[0-9]{2}" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
            </div>

            <hr style="border: 2px solid #252029; margin-top: 20px;">

            <div class="form-row">
                <div class="form-group col-md-6 mb-4">
                    <label for="password">Créer un mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Créer un mot de passe" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*\W).{12,}$" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
                <div class="form-group col-md-6 mb-4">
                    <label for="confirmPassword">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                        placeholder="Confirmer le mot de passe" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*\W).{12,}$" required />
                </div>
                <div class="invalid-feedback">Erreur</div>
            </div>
            <div class="form-check mt-1 text-center">
                <input class="form-check-input" type="checkbox" id="gridCheck" />
                <label class="form-check-label" for="gridCheck">
                    J'accepte les conditions générales.
                </label>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12 text-center">
                    <!-- Bouton "S'inscrire" -->
                    <button type="submit"class="custom-button mr-3">
                        S'inscrire
                    </button>
                    <!-- Bouton "Retour" -->
                    <a href="welcome.php" class="custom-button btn-secondary">
                        Retour
                    </a>
                </div>
            </div>
            

        </form>
    </div>
    
</body>



</html>