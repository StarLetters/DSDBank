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
    <h1><?php echo $inscrsupp ?></h1>
    <form method="post" action="validateAdmin.php">
        <button id="btnValider" >Valider</button>
        <button id="btnAnnuler" >Annuler</button>

        <?php

        $request = "SELECT * 
        FROM POrequete
        WHERE type_requete = '".$inscrsupp."';";
        $result = $cnx->prepare($request);
        $result->execute();
        $result = $result->fetchAll();

        foreach ($result as $row) {
            echo "<div class=\"row\">";
            echo $row['numSiren'];
            echo "<br>";
            echo $row['raisonSociale'];
            echo "<br>";
            echo "<input type=\"checkbox\"  id=\"validateUser ". $row['numSiren']."\" name=\"" . $row['numSiren'] . "\" value =\"validate\" onclick=\"handleClick(this)\"/>";
            echo "<br>";
            echo "<input type=\"checkbox\" id=\"deleteUser ". $row['numSiren']."\" name=\"" . $row['numSiren'] . "\" value =\"delete\" onclick=\"handleClick(this)\"/>";
            echo "</div>";
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