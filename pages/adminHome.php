<?php
session_start();


include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 3) {
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

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/Register.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/varColor.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/admin.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="../scripts/load.js"></script>
</head>




<body>


<div class="center-box">
        <div class="border-head">
            <h1>Menu Admin</h1>
        </div>

        <div class="form-row" style="justify-content: center; margin:2vw">

            <a href="adminProfile.php">Profil d'admin</a>&nbsp;&nbsp;
            <a href="../account/deco.php">Déconnexion</a>&nbsp;&nbsp;


        </div>

    </div>
    
</body>

</html>