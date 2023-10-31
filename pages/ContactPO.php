<?php




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
            <h1>Contact PO</h1>
        </div>


        <form method="POST" action="welcome.php" class="registration-form mt-4 needs-validation" id="registration-form" novalidate>
        <div>
            <div class="form-row">
                <div class="form-group col-md-12 mb-4"> <!-- Colonne de largeur 12 pour Noms -->
                    <label for="Name">Nom</label>
                    <input class="form-control" type="text" id="Name" name="Name" placeholder="Nom" maxlength="100" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
            </div>


                <hr style="border: 2px solid white; margin-top: 20px;">

            <div class="form-row">
                <div class="form-group col-md-12 mb-4"> <!-- Colonne de largeur 12 pour Email -->
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="50" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
            </div>

                <hr style="border: 2px solid white; margin-top: 20px;">

            <div class="form-row">
                <div class="form-group col-md-12 mb-4"> <!-- Colonne de largeur 12 pour Objet -->
                    <label for="Objet">Objet</label>
                    <input type="text" class="form-control" id="Objet" name="Objet" placeholder="Objet" maxlength="50" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
            </div>

                <hr style="border: 2px solid white; margin-top: 20px;">

            <div class="form-row">
                <div class="form-group col-md-12 mb-4"> <!-- Colonne de largeur 12 pour Objet -->
                    <label for="Text">Text</label>
                    <input type="text" class="form-control" id="Text" name="Text" placeholder="Text" maxlength="500" required />
                    <div class="invalid-feedback">Erreur</div>
                </div>
            </div>
        </div>

            <div class="form-row">
                <div class="form-group col-md-12 text-center">
                    <!-- Bouton "S'inscrire" -->
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