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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/varColor.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/impayes.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="../scripts/exportPDF.js"></script>
</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="col-12">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h1 class="mt-5">Mes impayés</h1>
                    </div>
                </div>

                <div class="form-row align-items-center">
                    <div class="col-12 col-md-6 d-flex flex-row">
                    <div class="col-auto mt-5">
                        <label for="startDate">Date de début :</label>
                        <input type="date" id="startDate" class="form-control form-control-sm date">
                    </div>

                    <div class="col-auto mt-5">
                        <label for="endDate">Date de fin :</label>
                        <input type="date" id="endDate" class="form-control form-control-sm date">
                    </div>
                    </div>
                    <div class="col-auto mt-5">
                        <label for="nImp">N° Dossier Impayés :</label>
                        <input type="text" id="nImp" class="form-control form-control-sm date">
                        <button id="resetButton">Effacer</button>
                        <button id="searchButton">Rechercher</button>
                    </div>
                    <?php
                    if ($role == 1) {
                        echo "
                    <div class=\"col-auto mt-5\">
                        <label for=\"nSiren\">N° SIREN :</label>
                        <input type=\"text\" id=\"nSiren\" class=\"form-control form-control-sm date\">
                    </div>";
                    }
                    ?>
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
                            <option value="datevente">Date Vente</option>
                            <option value="montant desc">Montant</option>
                        </select>
                    </div>
                </div>
                <div id="results-container" class="text-right">

                </div>
                <div id="table-container"></div>
                <nav id="pagination-container"></nav>
                <div class="row">
                    <select id="chartType" class="form-control mt-3 slide">
                        <option value="bar">Graphique à Barres</option>
                        <option value="line">Graphique à Courbes</option>
                    </select>

                    <div class="col-md-12 mt-5" id="barChartSection">
                        <h3>Somme des impayés par mois</h3>
                        <canvas id="barChart"></canvas>
                        <div class="col-auto mt-3">
                        <button style="border-radius: 10px;" onclick="exportChartToPDF('barChart', 'graphique_barres')">Exporter en PDF</button></div>
                    </div>

                    <div class="col-md-12 mt-5" id="lineChartSection">
                        <h3>Somme des impayés par mois</h3>
                        <canvas id="lineChart"></canvas>
                        <div class="col-auto mt-3">
                            <button style="border-radius: 10px;" onclick="exportChartToPDF('lineChart', 'graphique_courbes')">Exporter en PDF</button>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5">
                        <h3>Motifs d'impayés</h3>
                        <canvas id="pieChart"></canvas>
                        <div class="col-auto mt-3">
                        <button style="border-radius: 10px;" onclick="exportChartToPDF('pieChart', 'graphique_courbes')">Exporter en PDF</button>
                        </div>
                    </div>

                </div>
            </div>

            <?php include('../includes/footer.html'); ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

    <script defer type="module" src="../scripts/graphic.js"></script>
    <script defer type="module" src="../scripts/tempGraphics.js"></script>
    <script src="../scripts/button-nav.js"></script>
    <script defer type="module" src="../scripts/toggleDisplay.js"></script>

    <script src="../scripts/header.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

</body>

</html>