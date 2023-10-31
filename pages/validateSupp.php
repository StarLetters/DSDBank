<?php

session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 1) { // Si ce n'est pas un PO
    //header('Location: ../pages/welcome.php');
}


include('../backend/cnx.php');
if ($cnx->inTransaction()) {
    $cnx->rollBack();
}
$cnx->beginTransaction();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de validation</title>
</head>

<body>
    <p> Etes vous sûr de vouloir supprimer ces utilisateurs ? </p>

    <p> Ces utilisateurs seront demandés à être supprimés </p>
    <?php
    $request = "SELECT * 
        FROM Utilisateur
        JOIN Entreprise ON Entreprise.idUtilisateur = Utilisateur.idUtilisateur
        WHERE role = 'Client';";
    $result = $cnx->prepare($request);
    $result->execute();
    $result = $result->fetchAll();

    foreach ($result as $row) { // Afficher quel(s) client(s) vont être suppimé(s)
        if (isset($_POST[$row['email']])) {
            echo $row['raisonSociale'];
            echo "<br>";
        }
    }
    ?>
    <form action="suppAccount.php" method="post">
        <?php
        foreach ($result as $row) {
            if (isset($_POST[$row['email']])) {
                // Supprimer les demandes d'inscription et ajouter les demandes de suppression
                $requete = "DELETE FROM POrequete WHERE email = '" . $row['email'] . "';";
                $cnx->exec($requete);
                $requete = "INSERT INTO POrequete (email, type_requete) VALUES ('" . $row['email'] . "', 'suppression');";
                $cnx->exec($requete);
            }
        }
        ?>
        <button id="btnAnnuler">Non, retour</a>
            <button id="btnValider">Oui, supprimer</button>

    </form>

    <script>
        document.getElementById("btnAnnuler").onclick = function() {
            window.location.href ='../pages/poView.php?todotransaction=rollback' // Annuler la transaction
            
        };

        document.getElementById("btnValider").onclick = function() {            
            window.location.href ='../pages/poView.php?todotransaction=commit' // Valider la transaction  
        };
    </script>
</body>

</html>