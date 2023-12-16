<?php

session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 2) { // Si ce n'est pas un admin
    header('Location: ../pages/welcome.php');
}


include('../backend/cnx.php');
if ($cnx->inTransaction()) {
    $cnx->rollBack();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de validation</title>
    <link rel="shortcut icon" href="../data/img/LogoDSD.png" type="image/x-icon">
</head>

<body>
    <form action="suppAccount.php" method="POST">
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
            $email = $row['email'];
            $email = str_replace(".", "_", $email);
            if (isset($_POST[$email]) && $_POST[$email] == "on") {
                echo $row['raisonSociale'];
                echo "<br>";
                echo "<input type=\"hidden\" id=\"selectUser\" name=\"" . $row['email'] . "\" value=\"on\">";
                echo $row['email'];
            }
        }
        ?>
        <button type="reset" onclick="window.location.href = '../pages/adminView.php';">Annuler</button>
        <button type="submit">Valider</button>
    </form>
</body>

</html>