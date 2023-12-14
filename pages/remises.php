<?php
session_start();

// L'admin ne peut pas accéder à cette page
include('../account/verifLogin.php');
$role = verifLogin();
if ($role == 2) {
    header('Location: home.php');
}

if (!isset($_SESSION['cnxToken'])) {
    header('Location: ../index.html');
}
// Récupération du token de connexion pour le JS
setcookie('cnxToken', $_SESSION['cnxToken'], [
    'expires' => time() + 60 * 60 * 24,
    'secure' => true,
    'samesite' => 'None'
]);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de remise</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/varColor.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/remises.css">
</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="col-12">
                <div class="row mb-3">
                    <div class="col-12 col-md-12 text-center mt-5">
                        <h1 class="mt-5">Recherche de remise</h1>
                    </div>
                </div>
                
                    <?php
                    if ($role == 1) {
                        echo "
                        <div class=\"row mb-5\">
                        <div class=\"col-12 col-md-4 offset-md-4\">
                    <input type=\"text\" id=\"nSiren\" class=\"form-control form-control-sm date\" placeholder=\"N°SIREN\">
                    </div>
                    <div class=\"col-12 mt-2 mx-auto\">
                        <div class=\"row justify-content-center\">
                            <button id=\"resetButton-siren\" class=\"resetButton mx-1\">Effacer</button>
                            <button id=\"searchButton-siren\" class=\"searchButton mx-1\">Rechercher</button>
                        </div>
                    </div>
                    </div>";
                    }
                    echo "
                    <div id=\"email\" class=\"hidden\">".$_SESSION['email']."</div>
                    ";
                    ?>
                <div class="row mb-5">
                    <div class="col-12 col-md-4 offset-md-4">
                        <input type="text" id="nRemise" class="form-control form-control-sm date" placeholder="N°Remise">
                    </div>
                    <div class="col-12 mt-2 mx-auto">
                        <div class="row justify-content-center">
                            <button id="resetButton-remise" class="resetButton mx-1">Effacer</button>
                            <button id="searchButton-remise" class="searchButton mx-1">Rechercher</button>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between align-items-start mx-3 mb-3">
                    <div id="items-per-page-container">
                        <label for="items-per-page">Éléments par page:</label>
                        <select id="items-per-page" class="item-selecteur">
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div id="results-container" class="text-right"></div>
                    
                </div>
                <div class="row">
                <div id="table-container"></div>
                </div>
                <div class="row justify-content-center">
                <nav id="pagination-container" class="flex-row flex-wrap"></nav>
                </div>
                <div class="col-12 mt-5 d-flex flex-row flex-sm-column">
                    <div class="col-12 col-md-5 mb-5 ml-3">
                        <select id="export-select">
                            <option value="csv">Exporter en CSV</option>
                            <option value="xls">Exporter en XLS</option>
                        </select>       
                        <button id="export-button" class="export-button" onclick="exportTable()">Exporter</button>
                    </div>
                </div>
                <?php include('../includes/footer.html'); ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

        <script defer type="module" src="../scripts/remittance.js"></script>

        <script src="../scripts/header.js"></script>
        <script src="../scripts/exportData.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>