<?php

session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 2) { // Si ce n'est pas un PO
    //header('Location: ../pages/welcome.php');
}

include('../backend/cnx.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="post" action="validateSupp.php">
        <!-- TODO : Bouton Créer compte href="createAccount.php" -->
        <button id="btnSupp" onclick="suppCompte()"> Supprimer compte(s)</button>
        <button id="btnValider" type="submit" style="display:none">Valider</button>
        <button id="btnAnnuler" style="display:none">Annuler</button>

        <!-- TODO : Afficher les informations de tous les clients -->
        <?php

        $request = "SELECT * 
        FROM Utilisateur
        JOIN Entreprise ON Entreprise.idUtilisateur = Utilisateur.idUtilisateur
        WHERE role = 'Client';";
        $result = $cnx->prepare($request);
        $result->execute();
        $result = $result->fetchAll();

        foreach ($result as $row) { // Afficher les infos de chaque client

            echo "<input type=\"checkbox\" id=\"selectUser\" name=\"" . $row['email'] . "\" style=\"display:none\" />"; // Checkbox pour sélectionner les comptes à supprimer

            // Informations du client
            echo $row['numSiren'];
            echo "<br>";
            echo $row['raisonSociale'];
            echo "<br>";
            echo $row['email'];
            echo "<br>";

            // Vérifier une suppression ou une insertion a été demandé pour ce compte
            $request3 = "SELECT * FROM POrequete WHERE email ='" . $row['email'] . "';";
            $result3 = $cnx->prepare($request3);
            $result3->execute();
            $result3 = $result3->fetchAll();
            if (!empty($result3)) {
                echo $result3[0]['type_requete'] . " demandée"; // Afficher la demande
            } else {
                echo "OK"; // Status OK
            }
        }

        ?>

    </form>
    <script>
        function suppCompte() {
            // Code de sélection de comptes à supprimer

            event.preventDefault(); // On empêche le formulaire de s'envoyer

            document.getElementById("btnSupp").style.display = "none";
            document.getElementById("btnValider").style.display = "block";
            document.getElementById("btnAnnuler").style.display = "block";
            document.getElementById("selectUser").style.display = "block";
        }


        document.getElementById("btnAnnuler").onclick = function() {
            // Code d'annulation

            document.getElementById("btnSupp").style.display = "block";
            document.getElementById("btnValider").style.display = "none";
            document.getElementById("btnAnnuler").style.display = "none";
            document.getElementById("selectUser").style.display = "none";
        };
    </script>
</body>

</html>