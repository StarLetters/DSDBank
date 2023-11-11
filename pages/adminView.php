<?php

session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 2) { // Si ce n'est pas un Admin
    header('Location: ../pages/welcome.php');
}

include('../backend/cnx.php');
if ($cnx->inTransaction()) {
    $cnx->rollBack();
}
$request = "SELECT * 
FROM Utilisateur
JOIN Entreprise ON Entreprise.idUtilisateur = Utilisateur.idUtilisateur
WHERE role = 'Client';";
$result = $cnx->prepare($request);
$result->execute();



// Variables pour la pagination

// Nombre de lignes par page
if (isset($_GET['rowsPerPage'])) {
    $rowsPerPage = $_GET['rowsPerPage'];
} else {
    $rowsPerPage = 20;
}


// Récupère le numéro de page actuel depuis l'URL
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$totalRows = $result->rowCount();
$totalPages = ceil($totalRows / $rowsPerPage);
if ($currentPage < 1 || $currentPage > $totalPages) {
    $currentPage = 1;
}
// Calcule l'index de début et de fin des données à afficher
$startIndex = ($currentPage - 1) * $rowsPerPage;
$endIndex = min($startIndex + $rowsPerPage, $totalRows);

$result = $result->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profils</title>

    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/varColor.css">
    <link rel="stylesheet" href="../css/poView.css">
</head>

<body>
    <div id="wrapper">
        <?php include('../includes/header.php'); ?>
        <div class="col-12">
            <div class="row">
                <a href="welcome.php" class="custom-button btn-secondary"><span class="arrow-left">&#x2190;</span> Retour</a>
            </div>
            <form class="form-group px-2 md-px-5 py-1 d-flex flex-column align-items-center" id="formRows">
                <label for="exampleSelect" style="color:var(--couleur-text)">Sélectionnez le nombre de lignes à afficher :</label>
                <select name="rowsPerPage" class="form-control form-control-sm" style="width:15%" onchange="submitForm()">
                    <?php
                    echo "<option value=\"" . $rowsPerPage . "\" selected>" . $rowsPerPage . "</option>";

                    $optionRows = [5, 10, 20, 30, 50];
                    foreach ($optionRows as $option) {
                        if ($option != $rowsPerPage) {
                            echo "<option value=\"" . $option . "\">" . $option . "</option>";
                        }
                    }
                    ?>
                </select>
            </form>

            <form method="post" action="validateSupp.php">
                <div class="row d-flex flex-column flex-md-row flex-wrap justify-content-between mx-2 mb-4 mt-5 mt-md-0">
                    <p class="d-md-block text-white h2 text-center text-md-left">PROFILS</p>
                    <div class="d-flex align-items-center">
                        <!-- TODO : Bouton Créer compte href="createAccount.php" -->
                        <a href="createAccount.php" class="creer" id="btnCreer">Créer un compte</a>
                        <button id="btnSupp" onclick="suppCompte()"> Supprimer compte(s)</button>
                        <button id="btnValider" type="submit" style="display:none">Valider</button>
                        <button id="btnAnnuler" type="reset" style="display:none">Annuler</button>
                    </div>
                </div>
                <hr>

                <div class="row justify-content-between align-items-end px-4">
                    <p class="text-white align-bottom">
                        <?php
                        echo "Affichage de " . ($startIndex + 1) . " à " . $endIndex . " sur " . $totalRows . " résultats";
                        ?>
                    </p>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            <?php if ($currentPage > 1) {
                                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=";
                                echo $currentPage - 1;
                                echo "&rowsPerPage=".$rowsPerPage;

                                echo "\">&laquo;</a></li>";
                            }
                            ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <li class="page-item"><a class="page-link <?php if ($i == $currentPage) echo ' activePage'; ?>" href="?page=<?php echo $i."&rowsPerPage=".$rowsPerPage; ?>"><?php echo $i; ?></a></li>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages) {
                                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=";
                                echo $currentPage + 1;
                                echo "&rowsPerPage=".$rowsPerPage;
                                echo "\">&raquo;</a></li>";
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="hiding-check" scope="col" id="selectUser" style="display:none"><input type="checkbox" id="selectUser" name="po@gmail.com" style="display:none" disabled /></th>
                            <th scope="col">SIREN</th>
                            <th scope="col">Raison sociale</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        for ($i = $startIndex; $i < $endIndex; $i++) { // Afficher les infos de chaque client
                            $request2 = "SELECT * FROM POrequete WHERE email = '" . $result[$i]['email'] . "' AND type_requete = 'suppression';";
                            $result2 = $cnx->prepare($request2);
                            $result2->execute();
                            $result2 = $result2->fetchAll();
                            echo "<tr>";
                            echo "<td class=\"hiding-check\" scope=\"row\" id=\"selectUser\" style=\"display:none\"><input type=\"checkbox\" id=\"selectUser\" name=\"" . $result[$i]['email'] . "\" style=\"display:none\" ";
                            if (!empty($result2)) {
                                echo "checked disabled ";
                            }
                            echo "/></th>"; // Checkbox pour sélectionner les comptes à supprimer
                            // Informations du client
                            echo "<td scope=\"row\" data-label=\"SIREN\">";
                            echo $result[$i]['numSiren'];
                            echo "</td>";
                            echo "<td data-label=\"Raison sociale\">";
                            echo $result[$i]['raisonSociale'];
                            echo "</td>";
                            echo "<td data-label=\"Email\">";
                            echo $result[$i]['email'];
                            echo "</td>";
                            echo "<td data-label=\"Status\"";

                            // Vérifier une suppression ou une insertion a été demandé pour ce compte
                            $request3 = "SELECT * FROM POrequete WHERE email ='" . $result[$i]['email'] . "';";
                            $result3 = $cnx->prepare($request3);
                            $result3->execute();
                            $result3 = $result3->fetchAll();
                            if (!empty($result3)) {
                                echo "class=\"statusDemande\">"; // Status Demande
                                $date_requete = $result3[0]['date_requete'];
                                foreach ($result3 as $row2) { // Vérifier la dernière demande
                                    if ($row2['date_requete'] >= $date_requete) {
                                        $date_request = $row2['date_requete'];
                                        $last_request = $row2;
                                    }
                                }
                                echo $last_request['type_requete'] . " demandée"; // Afficher la demande
                            } else {
                                $request4 = "SELECT * FROM Utilisateur WHERE email ='" . $result[$i]['email'] . "' AND verifier=0;";
                                $result4 = $cnx->prepare($request4);
                                $result4->execute();
                                $result4 = $result4->fetchAll();
                                if (!empty($result4)) {
                                    echo "class=\"notVerified\">";
                                    echo "Email non vérifié";
                                } else {
                                    echo "class=\"statusOk\">"; // Status OK
                                    echo "OK"; // Status OK
                                }
                            }
                            echo "</td>";
                            echo "</tr>";
                        }

                        ?>
                    </tbody>
                </table>

            </form>
        </div>
        <?php include('../includes/footer.html'); ?>
    </div>

    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="../scripts/header.js"></script>
    <script>
        function suppCompte() {
            // Code de sélection de comptes à supprimer

            event.preventDefault(); // On empêche le formulaire de s'envoyer

            document.getElementById("btnSupp").style.display = "none";
            document.getElementById("btnCreer").style.display = "none";
            document.getElementById("btnValider").style.display = "block";
            document.getElementById("btnAnnuler").style.display = "block";
            const elements = document.querySelectorAll('[id="selectUser"]');
            // Parcourir tous les éléments
            elements.forEach((element) => {
                // Effectuer les modifications souhaitées sur chaque élément
                element.style.display = 'table-cell';
            });
        }

        document.getElementById("btnAnnuler").onclick = function() {
            // Code d'annulation

            document.getElementById("btnSupp").style.display = "block";
            document.getElementById("btnCreer").style.display = "block";
            document.getElementById("btnValider").style.display = "none";
            document.getElementById("btnAnnuler").style.display = "none";
            const elements = document.querySelectorAll('[id="selectUser"]');
            elements.forEach((element) => {
                element.style.display = 'none';
            });
        };

        function submitForm() {
            document.getElementById("formRows").submit();
        }
    </script>
</body>

</html>