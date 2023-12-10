<?php
session_start();

include('../account/verifLogin.php');
$role = verifLogin();

if (!isset($_SESSION['cnxToken'])) {
    header('Location: ../index.html');
}
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
    <title>Mes impayés</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/varColor.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/impayes.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="../scripts/exportData.js"></script>
</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="col-12">
                <div class="row mb-5">
                    <div class="col-12 col-md-12 text-center mt-5">
                        <h1 class="mt-4">Mes impayés</h1>
                    </div>
                </div>


                <div class="form-row align-items-center">
                    <div class="col-12 col-md-6 mx-auto">
                        <div class="hidePO text-center" id="date-container">
                            <label for="choiceDateImp">Dater par : </label>
                            <select id="choiceDateImp" class="item-selecteur">
                                <option value="custom" id="dateCustomImp">Dates personnalisées</option>
                                <option value="4months">Évolution sur 4 mois glissants</option>
                                <option value="12months">Évolution sur 12 mois glissants</option>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="col-12 col-md-12 d-flex flex-row">
                    <div class="col-12 col-md-6 d-flex flex-row" id="selectDate">
                        <div class="col-auto mt-5">
                            <label for="startDate">Date de début :</label>
                            <input type="date" id="startDate" class="form-control form-control-sm date">
                        </div>

                        <div class="col-auto mt-5">
                            <label for="endDate">Date de fin :</label>
                            <input type="date" id="endDate" class="form-control form-control-sm date">
                        </div>
                    </div>

                    <div class="col-2 mt-5 col-md-6">
                        <label for="nImp">N° Dossier Impayés :</label>
                        <input type="text" id="nImp" class="form-control form-control-sm date">
                        <?php
                        if ($role == 1) {
                            echo "
                        <label for=\"nSIREN\">N° SIREN :</label>
                        <input type=\"text\" id=\"nSIREN\" class=\"form-control form-control-sm date\">
                        
                        <label for=\"raisonSociale\">Raison Sociale :</label>
                        <input type=\"text\" id=\"raisonSociale\" class=\"form-control form-control-sm date\">
                        ";
                        }
                        ?>
                        <div class="col-12">
                            <div class="d-flex">
                                <button id="resetButton">Effacer</button>
                                <button id="searchButton">Rechercher</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row align-items-center">
                    <div id="items-per-page-container" class="mx-3">
                        <label for="items-per-page">Éléments par page:</label>
                        <select id="items-per-page" class="item-selecteur">
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div id="order-by-container">
                        <label for="order-by">Trier par:</label>
                        <select id="order-by" class="item-selecteur">
                            <option value="montantDesc">Montant décroissant</option>
                            <option value="montantAsc">Montant croissant</option>
                            <option value="motif" id="motifImp" class="hidePO">Motif</option>
                            <option value="datevente" id="datevente" class="hidePO">Plus ancien</option>
                            <option value="dateventeAsc" id="dateventeAsc" class="hidePO">Plus récent</option>
                            <?php
                            if ($role == 1) {
                                echo "<option value=\"numSiren\" id=\"orderSiren\">N° SIREN</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <select id="export-select">
                        <option value="csv" onclick="exportTable()">Exporter en CSV</option>
                        <option value="xls" onclick="exportTable()">Exporter en XLS</option>
                    </select>
                    <div id="results-container" class="col-9 text-right"></div>
                </div>
                <!-- <button class="export-button" >Exporter</button> -->
                <div id="table-container"></div>
                <nav id="pagination-container"></nav>


                <div class="hidePO row" id="graphics">
                    <select id="chartType" class="form-control mt-3 slide">
                        <option value="bar">Graphique à Barres</option>
                        <option value="line">Graphique à Courbes</option>
                    </select>

                    <div class="col-md-12 mt-5" id="barChartSection">

                        <h3>Somme des impayés par mois</h3>
                        <div class="chart">
                            <canvas id="barChart"></canvas>
                        </div>
                        <div class="col-auto mt-3">
                            <div class="col-auto mt-3">
                                <button class="export-pdf-button"
                                    onclick="exportTableToPDF('barChart', 'graphique_barres', 'pdf', 750, 400)">Exporter
                                    en PDF</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5" id="lineChartSection">
                        <h3>Somme des impayés par mois</h3>
                        <div class="chart">
                            <canvas id="lineChart"></canvas>
                        </div>
                        <div class="col-auto mt-3">
                            <div class="col-auto mt-3">
                                <button
                                    onclick="exportTableToPDF('lineChart', 'graphique_courbes', 'pdf', 750, 400)">Exporter
                                    en PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5 mb-4">
                    <h3>Motifs d'impayés</h3>
                    <canvas id="pieChart"></canvas>
                    <div class="col-auto mt-3">
                        <button class="export-pdf-button"
                            onclick="exportTableToPDF('pieChart', 'graphique_cam', 'pdf', 750, 400)">Exporter en
                            PDF</button>
                    </div>
                </div>

            </div>
        </div>

        <?php include('../includes/footer.html'); ?>

    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

    <script defer type="module" src="../scripts/graphic.js"></script>
    <script defer type="module" src="../scripts/unpaid.js"></script>

    <script src="../scripts/header.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>


</body>

</html>