<?php
session_start();


include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 2) {
    header('Location: ../pages/welcome.php');
}

include('../backend/cnx.php');

$request = "SELECT type_requete, COUNT(*) FROM POrequete WHERE type_requete IN ('inscription', 'suppression') GROUP BY type_requete;";
$result = $cnx->prepare($request);
$result->execute();
$result = $result->fetchAll(PDO::FETCH_KEY_PAIR);
$nbInscr = $result['inscription'] ?? 0;
$nbSupp = $result['suppression'] ?? 0;


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Panel Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

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


        <div class="form-row justify-content-around align-items-center m-5">

            <div class="w-35">
            <a href="../pages/adminInscrSupp.php?InscrSupp=inscription"><button id="btnInscr" class="btn btn-success btn-lg btn-sans-decoration btn-texte-blanc w-100">Demandes d'inscription (<?php echo $nbInscr; ?>)</button> </a>
            </div>

            <div class="w-35">
            <a class="w-100" href="../pages/adminInscrSupp.php?InscrSupp=suppression"><button id="btnSupp" class="btn btn-danger btn-lg btn-sans-decoration btn-texte-blanc w-100">Demandes de suppression (<?php echo $nbSupp; ?>)</button> </a>
            </div>

        </div>
        <a href="../account/deco.php"><button class="float-right btn-deconnexion text-decoration-none">Se déconnecter</button></a>

        </div>

    </div>
    
</body>

</html>