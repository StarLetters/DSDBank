<?php
session_start();


if (isset($_POST['subject']) && isset($_POST['name']) && isset($_POST['text']) && isset($_POST['sender'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $body = $_POST['text'];
    $sender = $_POST['sender'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Contact Responsable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/Register.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/varColor.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/formCorrections.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/global.css" />



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="../scripts/load.js"></script>
    <script defer src="../scripts/passwordMatch.js"></script>
</head>

<body>
    <div class="center-box">
        <div class="border-head">
            <p class="text-white h4">Contacter l<?php echo isset($_POST['sender']) ? "'administrateur" : "e Responsable"; ?></p>
        </div>


        <form method="POST" action="../backend/mailer.php" class="registration-form mt-4 needs-validation" id="registration-form" novalidate>
            <div>
                <?php
                    echo '<input type="hidden" name="which" value="contact">';
                    if (isset($_POST['sender'])){
                        echo '<input type="hidden" name="sender" value="'.$_POST['sender'].'">';
                    }
                    else{
                        echo '
                <div class="form-row">
                    <div class="form-group col-md-6 mb-4"> <!-- Colonne de largeur 12 pour Email -->
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="50" required />
                        <div class="invalid-feedback">Erreur</div>
                    </div>
                    <div class="form-group col-md-6 col-sm-12 mb-4"> <!-- Utilisation des classes col-md-12 col-sm-12 pour une largeur maximale sur les petits écrans -->
                        <label for="name">Nom</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Nom" maxlength="100" required />

                        <div class="invalid-feedback">Erreur</div>
                    </div>
                </div>';
                    }
                ?>
                <div class="form-row">
                <div class="form-group col-md-12 mb-4">
                        <label for="subject">Objet</label>
                        <textarea class="form-control" id="subject" name="subject" placeholder="Demande" rows="1" required></textarea>

                        <div class="invalid-feedback">Erreur</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12 mb-4">

                        <label for="text">Texte</label>
                        <textarea class="form-control" id="text" name="text" placeholder="Bonjour..." rows="6" required></textarea>

                        <div class="invalid-feedback">Erreur</div>
                    </div>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-12 text-center">
                    <button type="submit" class="custom-button mr-3">
                        Envoyer
                    </button>
                </div>
            </div>
    </div>

    <!-- Bouton "Retour" -->
    <a href="welcome.php" class="custom-button btn-secondary"><span class="arrow-left">&#x2190;</span> Retour</a>
    </form>
    </div>

</body>

</html>