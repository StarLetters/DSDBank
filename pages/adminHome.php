<?php
session_start();


include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 2) {
    header('Location: ../pages/welcome.php');
}

include('../backend/cnx.php');


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Panel Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="../data/img/LogoDSD.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/Register.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/varColor.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/global.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="../scripts/load.js"></script>
</head>

<body class="adminHome">


<div class="center-box">
        <div class="border-head">
            <h1>Menu Admin</h1>
        </div>

        <div class="form-group text-center m-3">

            <a  href="../pages/adminView.php"><button class="btn btn-option my-5 p-3" style="font-size:1.5rem">Voir les profils</button></a>

        </div>
        
        <a href="../account/deco.php"><button class="float-right btn-deconnexion text-decoration-none">Se déconnecter</button></a>

        </div>

    </div>
    
</body>

</html>