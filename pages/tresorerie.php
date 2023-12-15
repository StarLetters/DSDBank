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

                <div class="align-items-center d-flex flex-column justify-content-center">
                    <div class="col-12 col-md-6" id="search-container">
                        <label for="nSIREN" class="mt-3">N° SIREN :</label>
                        <input type="text" id="nSIREN" class="form-control form-control-sm date">

                        <?php
                        if ($role == 0) {
                            echo "<div id=\"numSiren\" class=\"hidden\">" . $_SESSION['numSiren'] . "</div>";
                        }
                        if ($role == 1) {
                            echo '  
                                        
                                        <label class="mt-2" for="dateValeur">Date de la valeur</label>
                                        <input type="date" id="dateValeur" class="form-control form-control-sm dateValeur order-md-1">
                                        <label for="raisonSociale" class="mt-3">Raison Sociale :</label>
                                        <input type="text" id="raisonSociale" class="form-control form-control-sm date">
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

                        <button class="export-button col-2 col-sm-4" style="max-width:fit-content; width:auto;" onclick="exportTable()">Exporter</button>
                        <select id="export-select" class="col-4 col-sm-4" style="max-width:fit-content; width:auto;">
                            <option value="csv">en CSV</option>
                            <option value="xls">en XLS</option>
                            <option value="pdf">en PDF</option>
                        </select>
                    </div>
                    <nav id="pagination-container"></nav>

                </div>
                <?php
                if ($role == 1) {
                    /*$nSiren = ;
                        include("../account/getReason.php");
                        $raison = getReason($nSiren);
                        $titre = "L'ENTREPRISE ".$raison." N°SIREN ".$nSiren;
                        $button = "<button class=\"export-pdf-button\" id=\"export-pdf\" 
                        onclick=\"exportChartToPDF('lineChart', 'GRAPHIQUE DES TRESORERIES DE ".$titre.", 'pdf', 750, 400)\">Exporter en PDF</button>";*/
                    echo "
                    <div class=\"col-md-12 mt-5\" id=\"lineChartSection\">
                    <h2 id=\"chartTitle\" class=\"mb-3\">Evolution de la trésorerie</h2>
                    <canvas id=\"lineChart\"></canvas>
                    <div class=\"col-auto mt-3\">";
                    /* boutton d'export */
                    echo "
                    </div>
                    </div>";
                }
                ?>
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