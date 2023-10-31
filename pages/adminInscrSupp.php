<?php

session_start();

if (!isset($_SESSION['InscrSupp'])) { // Si l'admin n'a pas cliqué sur un bouton
    header('Location: ../pages/welcome.php');
}else{
    $inscrsupp = $_SESSION['InscrSupp'];
}

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 3) { // Si ce n'est pas un admin
    //header('Location: ../pages/welcome.php');
}


include('../backend/cnx.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $inscrsupp ?></title>
</head>

<body>
<<<<<<< Updated upstream
    <h1><?php echo $inscrsupp ?></h1>
    <form method="post" action="validateAdmin.php">
        <button id="btnValider" >Valider</button>
        <button id="btnAnnuler" >Annuler</button>
=======

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
>>>>>>> Stashed changes

        <?php

        $request = "SELECT * 
        FROM POrequete
        WHERE type_requete = '".$inscrsupp."';";
        $result = $cnx->prepare($request);
        $result->execute();
        $result = $result->fetchAll();

        $i = 1;
        foreach ($result as $row) {
<<<<<<< Updated upstream
            echo "<div class=\"row\">";
            echo $row['numSiren'];
            echo "<br>";
            echo $row['raisonSociale'];
            echo "<br>";
            echo "<input type=\"checkbox\"  id=\"validateUser ". $row['numSiren']."\" name=\"" . $row['numSiren'] . "\" value =\"validate\" onclick=\"handleClick(this)\"/>";
            echo "<br>";
            echo "<input type=\"checkbox\" id=\"deleteUser ". $row['numSiren']."\" name=\"" . $row['numSiren'] . "\" value =\"delete\" onclick=\"handleClick(this)\"/>";
            echo "</div>";
=======

            echo "<tr>";
            echo "<th scope='row' class='text-light'>".$i++."</th>";
            echo "<td class='text-light'>".$row['raisonSociale']."</td>";
            echo "<td class='text-light'>".$row['numSiren']."</td>";
            echo "<td class='text-light'> <input type='checkbox' name='".$row['numSiren']."' value='+".$row['numSiren']."' onclick=\"handleClick(this)\"/> </td>";
            echo "<td class='text-light'> <input type='checkbox' name='".$row['numSiren']."' value='-".$row['numSiren']."' onclick=\"handleClick(this)\"/> </td>";
            echo "</tr>";

            // A REPARER, envoyer une liste des numéros SIREN via POST
>>>>>>> Stashed changes
        }

        ?>

    </form>
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


        document.getElementById("btnAnnuler").onclick = function() {
            // Code d'annulation
            <?php
            header('Location: ../pages/adminProfil.php')
            ?>
        };
    </script>
</body>

</html>