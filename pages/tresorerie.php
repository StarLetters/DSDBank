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
]); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces de trésorerie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/varColor.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/impayes.css">
    <link rel="stylesheet" href="../css/tresorerie.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="col-12">
                <div class="row mb-3">
                    <div class="col-md-12 mt-5">
                        <h1 class="mt-5 mb-5 text-center">Annonces de trésorerie</h1>
                    </div>
                </div>
                <div>
                    <?php
                    if ($role == 1) {
                        echo "
                    <label for=\"nSIREN\">N° SIREN :</label>
                    <input type=\"text\" id=\"nSIREN\" class=\"form-control form-control-sm date\">
                    
                    
                    <button id=\"resetButton\">Effacer</button>
                    <button id=\"searchButton\">Rechercher</button>";
                    }
                    ?>
                </div>
                <div id="order-by-container">
                    <?php
                    if ($role == 1) {
                        echo "
                    <label for=\"order-by\">Trier par:</label>
                    <select id=\"order-by\" class=\"item-selecteur\">
                        <option value=\"montantDesc\">Montant décroissant</option>
                        <option value=\"montantAsc\">Montant croissant</option>
                        <option value=\"numSiren\" id=\"orderSiren\">N° SIREN</option> 
                    </select>";
                    }
                    ?>
                </div>
                <div>
                    
                    <div id="items-per-page-container" class="mx-3 mb-sm-3">
                        <label for="items-per-page">Éléments par page:</label>
                        <select id="items-per-page" class="item-selecteur col-1 col-sm-3">
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div id="results-container" class="text-right mb-2"></div>

                    <div id="table-container"></div>
                    <div class="col-md-12 col-lg-6 mb-5">
                            <select id="export-select" class="col-4 col-sm-4">
                                <option value="csv">Exporter en CSV</option>
                                <option value="xls">Exporter en XLS</option>
                            </select>
                            <button class="export-button col-2 col-sm-4" onclick="exportTable()">Exporter</button>
                        </div>
                    <nav id="pagination-container"></nav>

                </div>
                <div class="col-md-12 mt-5" id="lineChartSection">
                    <h1 id="chartTitle">Evolution de la trésorerie</h1>
                    <canvas id="lineChart"></canvas>
                    <div class="col-auto mt-3">
                        <button class="export-pdf-button" onclick="exportTableToPDF('lineChart', 'GRAPHIQUE DES TRESORERIES DE <?php echo strtoupper($_SESSION['displayName'] . ' ' .  'NSIREN ' . $_SESSION['numSiren']) ?>', 'pdf', 750, 400)">Exporter en PDF</button>
                    </div>
                </div>
            </div>
            <?php include('../includes/footer.html'); ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

        <script defer type="module" src="../scripts/treasury.js"></script>

        <script src="../scripts/header.js"></script>
        <script src="../scripts/exportData.js"></script>
        <script defer type="module" src="../scripts/graphic.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
        <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

</body>

</html>