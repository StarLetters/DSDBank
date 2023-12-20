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


include '../backend/utilities.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces de trésorerie</title>
    <link rel="shortcut icon" href="../data/img/LogoDSD.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/varColor.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/impayes.css">
    <link rel="stylesheet" href="../css/tresorerie.css">
</head>

<body>
    <div id="token" data-token="<?php echo $_SESSION['cnxToken'];?>">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="col-12">
                <div class="row mb-3">
                    <div class="col-md-12 mt-5">
                        <h1 class="mt-5 mb-5 text-center">Annonces de trésorerie</h1>
                    </div>
                </div>

                <div class="align-items-center d-flex flex-column justify-content-center">
                    <div class="col-12 col-md-6" id="search-container">
                        <label class="mt-2" for="dateValeur">Date de la valeur</label>
                        <input type="date" id="dateValeur" class="form-control form-control-sm dateValeur order-md-1">
                        <?php
                        if ($role == 1) {
                            echo '
                                <label for="nSIREN" class="mt-3">N° SIREN :</label>
                                <input type="text" id="nSIREN" class="form-control form-control-sm date" placeholder="1234567889">
                                <label for="raisonSociale" class="mt-3">Raison Sociale :</label>
                                <input type="text" id="raisonSociale" class="form-control form-control-sm date" placeholder="DSDCorp">
                                    ';
                        }
                        ?>
                        <div class="d-flex flex-column flex-md-row mt-2">
                            <button id="resetButton" class="align-self-center my-1">Effacer</button>
                            <button id="searchButton" class="align-self-center my-1">Rechercher</button>
                        </div>
                    </div>
                </div>

                <div id="order-by-container">
                </div>

                <div class="row mt-5 ct1 mr-3">
                    <div id="order-by-container" class="col-md-12 col-lg-6 order-by">
                        <?php
                        if ($role == 1) {
                            echo "
                                <label for=\"order-by\">Trier par:</label>
                                    <select id=\"order-by\" class=\"item-selecteur\" style='width:auto;'>
                                        <option value=\"montantDesc\">Montant décroissant</option>
                                        <option value=\"montantAsc\">Montant croissant</option>
                                        <option value=\"numSiren\" id=\"orderSiren\">N° SIREN</option> 
                                    </select>
                                ";
                        }
                        ?>
                    </div>
                    <div id="items-per-page-container" class="col-md-12 col-lg-6">
                        <div style="justify-content: end; display: flex; align-content: center">
                            <label for="items-per-page" style="margin-bottom:0;">Éléments par page : &nbsp;</label>
                            <select id="items-per-page" class="item-selecteur col-1 col-sm-1">
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div id="results-container" class="text-right"></div>
                    </div>

                </div>
                <div>
                    <div id="table-container"></div>
                    <div class="col-md-12 col-lg-6 my-2 ml-3">
                        <?php 
                        $filename = 'TABLEAU ANNONCES DE TRESORERIE';
                        $onclick = getOnClickTable($role, $filename);
                        ?>
                        <button class="export-button" style="padding: 4px 15px;" onclick="<?php echo $onclick ?>">Exporter</button>
                        <select id="export-select" style="width:auto; padding: 4px 15px;">
                            <option value="csv">en CSV</option>
                            <option value="xls">en XLSX</option>
                            <option value="pdf">en PDF</option>
                        </select>
                    </div>
                    <nav id="pagination-container"></nav>

                </div>
                <div class="col-md-12 mt-5" id="lineChartSection">
                    <h1 id="chartTitle">Evolution de la trésorerie</h1>
                    <canvas id="lineChart"></canvas>
                    <div class="col-auto mt-3">
                        <?php
                        $filename = 'GRAPHIQUE EVOLUTION DE LA TRESORERIE';
                        $onclick = getOnclick($role, $filename, 'lineChart', 800, 400);
                        echo "<button class=\"export-pdf-button\" onclick=\"" . htmlspecialchars($onclick) . "\">Exporter en PDF</button>";
                        ?>
                    </div>
                </div>
            </div>
            <?php include('../includes/footer.html'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

    <script defer type="module" src="../scripts/treasury.js"></script>

    <script src="../scripts/header.js"></script>
    <script src="../scripts/exportData.js"></script>
    <script defer type="module" src="../scripts/graphic.js"></script>

    </body>

</html>