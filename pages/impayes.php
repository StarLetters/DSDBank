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
// On crée un cookie qui va servir au JS pour les requêtes
setcookie('cnxToken', $_SESSION['cnxToken'], [
    'expires' => time() + 60 * 60 * 24,
    'secure' => true,
    'samesite' => 'None'
]);

include '../backend/utilities.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes impayés</title>
    <link rel="shortcut icon" href="../data/img/LogoDSD.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/varColor.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/impayes.css">
    <link rel="stylesheet" href="../css/amountColors.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="col-12 p-3">
                <div class="row mb-5">
                    <div class="col-12 col-md-12 text-center mt-5">
                        <h1 class="mt-4">Mes impayés</h1>
                    </div>
                </div>
                <div class="row mt-4 ct1 flex-column flex-md-row mb-3">
                    <div class="hidePO col-12 col-md-6 align-items-center flex-row order-md-2">
                        <div class="col-12 mx-auto mt-auto">
                            <div class="hidePO text-center" id="date-container">
                                <label for="choiceDateImp">Dater par : </label>
                                <select id="choiceDateImp" class="item-selecteur col-5 col-sm-6">
                                    <option value="custom" id="dateCustomImp">Dates personnalisées</option>
                                    <option value="4months">Évolution sur 4 mois glissants</option>
                                    <option value="12months">Évolution sur 12 mois glissants</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3 mb-md-0" id="selectDate">
                            <div class="row">
                                <div class="col-6">
                                    <label for="startDate">Date de début :</label>
                                    <input type="date" id="startDate" class="form-control form-control-sm date col-12">
                                </div>
                                <div class="col-6">
                                    <label for="endDate">Date de fin :</label>
                                    <input type="date" id="endDate" class="form-control form-control-sm date col-12">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" id="search-container">
                        <label class="mt-2" for="nImp">N° Dossier Impayés :</label>
                        <input type="text" id="nImp" class="form-control form-control-sm nImp order-md-1">
                        <?php
                        if ($role == 1) {
                            echo '  
                                    <label for="nSIREN" class="mt-3">N° SIREN :</label>
                                    <input type="text" id="nSIREN" class="form-control form-control-sm date">
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
                <hr class="mt-5 mb-5">
                <div class="row"></div>
                <div class="row mt-5 ct1">
                    <div id="items-per-page-container" class="col-md-12 col-lg-6">
                        <label for="items-per-page">Éléments par page:</label>
                        <select id="items-per-page" class="item-selecteur col-1 col-sm-1">
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div id="order-by-container" class="col-md-12 col-lg-6 order-by">
                        <label for="order-by">Trier par:</label>
                        <select id="order-by" class="item-selecteur col-6 col-sm-6">
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
                <div class="ct1">
                    <div class="row my-3">
                        <div class="col-md-12 col-lg-6 mb-2">
                            <select id="export-select" class="col-5 col-sm-6">
                                <option value="csv">Exporter en CSV</option>
                                <option value="xls">Exporter en XLS</option>
                                <option value="pdf">Exporter en PDF</option>
                            </select>
                            <?php
                            $filename = 'TABLEAU DES IMPAYES';
                            $onclick = getOnClickTable($role, $filename);
                            ?>
                            <button class="export-button col-2 col-sm-4" onclick="<?php echo $onclick ?>">Exporter</button>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div id="results-container" class="text-right ct2"></div>
                        </div>
                    </div>
                </div>

                <div id="table-container"></div>

                <nav id="pagination-container"></nav>

                <div class="hidePO row mt-5" id="graphics">

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
                                <?php 
                                $filename = 'GRAPHIQUE A BARRES DES IMPAYES';
                                $onclick = getOnclick($role, $filename, 'barChart', 800, 400);
                                echo "<button class=\"export-pdf-button\" onclick=\"" . htmlspecialchars($onclick) . "\">Exporter en PDF</button>";
                                ?>
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
                                <?php 
                                $filename = 'GRAPHIQUE LINEAIRE DES IMPAYES';
                                $onclick = getOnclick($role, $filename, 'lineChart', 800, 400);
                                echo "<button class=\"export-pdf-button\" onclick=\"" . htmlspecialchars($onclick) . "\">Exporter en PDF</button>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5 mb-4">
                    <h3 class="pt-5">Motifs d'impayés</h3>
                    <canvas id="pieChart"></canvas>
                    <div class="col-auto mt-3">
                        <?php
                        $filename = 'GRAPHIQUE DES MOTIFS IMPAYES';
                        $onclick = getOnclick($role, $filename, 'pieChart', 800, 400);
                        echo "<button class=\"export-pdf-button\" onclick=\"" . htmlspecialchars($onclick) . "\">Exporter en PDF</button>";
                        ?>
                    </div>
                </div>

            </div>
            <?php include('../includes/footer.html'); ?>
        </div>



    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

    <script defer type="module" src="../scripts/graphic.js"></script>
    <script defer type="module" src="../scripts/unpaid.js"></script>
    <script src="../scripts/exportData.js"></script>

    <script src="../scripts/header.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>


</body>

</html>