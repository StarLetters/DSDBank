<?php

session_start();

if (!isset($_GET['InscrSupp'])) { // Si l'admin n'a pas cliqué sur un bouton
    header('Location: ../pages/welcome.php');
}else{
    $inscrsupp = $_GET['InscrSupp'];
}

require('../account/verifLogin.php');
$verif = verifLogin();	
if ($verif !== 2){
    header('Location: ../pages/welcome.php');
}

include('../backend/cnx.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/Register.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/varColor.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="../scripts/load.js"></script>
    <title><?php echo $inscrsupp ?></title>
</head>

<body>

    <h1><?php echo $inscrsupp ?></h1>
    <form method="post" action="validateAdmin.php">
        <button id="btnValider" >Valider</button>
        <button id="btnAnnuler" >Annuler</button>


<div class="center-box">
        <div class="border-head">
    <h1><?php echo $inscrsupp ?> de comptes</h1>
        </div>
    
    <form class="table-responsive" method="post" action="validateAdmin.php">
        <div class="form-group text-center m-3">

            <input type='submit' value="Valider"/>
            <input type='text' id="yoo" name="okok" value="yeaah">
    
            <button id="btnAnnuler" href="../pages/adminHome.php" >Annuler</button>

        </div>


        <table class="table table-bordered"> <!-- Début de la table -->
        <thead>
            <tr>
                <th scope="col" class="text-light">#</th>
                <th scope="col" class="text-light">Numéro Sociale</th>
                <th scope="col" class="text-light">N° SIREN</th>

                <th scope="col" class="text-light"> <?php echo $_GET['InscrSupp'] == 'inscription' ? "Inscrire" : "Supprimer" ?></th>
                <th scope="col" class="text-light"> <?php echo $_GET['InscrSupp'] == 'inscription' ? "Refuser" : "Garder" ?></th>
             </tr>
        </thead>
        <tbody>

        <?php

        $request = "SELECT ent.numSiren, ent.raisonSociale
        FROM POrequete req

        JOIN Utilisateur ON Utilisateur.email = req.email
        JOIN Entreprise ent ON ent.idUtilisateur = Utilisateur.idUtilisateur
    
        WHERE req.type_requete = '".$inscrsupp."';";
        $result = $cnx->prepare($request);
        $result->execute();
        $result = $result->fetchAll();

        $i = 1;
        foreach ($result as $row) {

            echo "<tr>";
            echo "<th scope='row' class='text-light'>".$i++."</th>";
            echo "<td class='text-light'>".$row['raisonSociale']."</td>";
            echo "<td class='text-light'>".$row['numSiren']."</td>";
            echo "<td class='text-light'> <input type='checkbox' name='".$row['numSiren']."' value='+".$row['numSiren']."' onclick=\"handleClick(this)\"/> </td>";
            echo "<td class='text-light'> <input type='checkbox' name='".$row['numSiren']."' value='-".$row['numSiren']."' onclick=\"handleClick(this)\"/> </td>";
            echo "</tr>";

            // A REPARER, envoyer une liste des numéros SIREN via POST
        }

        ?>

    
        
        </tbody>
    </table>
    </form>
        </div>
</div>
    <script>

        function handleClick(checkbox){
            // Désactiver la checkbox
            checkbox.disabled = true;

            var checkboxId = checkbox.id;
            var associatedInputId;
            if (checkboxId.includes("validate")){
                // Si c'est une validation, on cache la suppression
                associatedInputId= checkboxId.replace("validate", "delete");
            }else if (checkboxId.includes("delete")){
                // Si c'est une suppression, on cache la validation
                associatedInputId = checkboxId.replace("delete", "validate");
            }
            var associatedInput = document.getElementById(associatedInputId);
            associatedInput.style.display = "none";
        }

    </script>
</body>

</html>