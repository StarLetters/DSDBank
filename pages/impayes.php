<?php 
session_start();

if (!isset($_SESSION['cnxToken'])) {
    header('Location: ../index.html');
}
setcookie('cnxToken', $_SESSION['cnxToken'], [
    'expires' => time() + 60 * 60 * 24,
    
    'secure' => true,
    'samesite' => 'None'
]);?>
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
</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="mt-5">Mes impayés</h1>
                    </div>
                </div>
                
                <div class="form-row align-items-center">
                    <div class="col-auto mt-5">
                        <label for="startDate">Date de début :</label>
                        <input type="date" id="startDate" class="form-control form-control-sm">
                    </div>

                    <div class="col-auto mt-5">
                        <label for="endDate">Date de fin :</label>
                        <input type="date" id="endDate" class="form-control form-control-sm">
                    </div>                

                    <div class="col-auto mt-5">
                        <label for="nImp">N° Dossier Impayés :</label>
                        <input type="text" id="nImp" class="form-control form-control-sm">
                    </div>

                    <div class="col-auto mt-5">
                        <label for="nSiren">N° SIREN :</label>
                        <input type="text" id="nSiren" class="form-control form-control-sm">
                    </div>

                </div>

                <div id="table-container"></div>
                <div class="row">
                    <select id="chartType" class="form-control mt-3">
                        <option value="bar">Graphique à Barres</option>
                        <option value="line">Graphique à Courbes</option>
                    </select>

                    <div class="col-md-12 mt-5" id="barChartSection">
                        <h3>Somme des impayés par mois</h3>
                        <canvas id="barChart"></canvas>
                        <div class="col-auto mt-3">
                        <button style="border-radius: 10px;" onclick="exportChartToPDF('barChart', 'graphique_barres')">Exporter en PDF</button>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5" id="lineChartSection">
                        <h3>Somme des impayés par mois</h3>
                        <canvas id="lineChart"></canvas>
                        <div class="col-auto mt-3">
                        <button style="border-radius: 10px;" onclick="exportChartToPDF('courbeChart', 'graphique_courbes')">Exporter en PDF</button>
                        </div>
                    </div>

                </div>
            </div>

            <?php include('../includes/footer.html'); ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
    <script defer type="module" src="../scripts/graphic.js"></script>
    <script src="../scripts/button-nav.js"></script>
    <script src="../scripts/header.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- guette pas ça -->
    <script>
    
    function exportChartToPDF(chartId, fileName) {
    const canvas = document.getElementById(chartId);

    // Récupère le contexte du canvas
    const ctx = canvas.getContext('2d');

    // Créer un nouvel objet Chart en utilisant le contexte du canvas
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Dataset',
                data: [10, 20, 30],
                backgroundColor: ['red', 'green', 'blue']
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    display: false
                }],
                yAxes: [{
                    display: false
                }]
            },
            legend: {
                display: false
            }
        }
    });

    // Créer un nouvel objet jsPDF
    const pdf = new jsPDF();

    // Obtiens les dimensions du canvas
    const canvasWidth = canvas.width;
    const canvasHeight = canvas.height;

    // Créer une image à partir des données du canvas
    const imgData = canvas.toDataURL('image/png');

    // Ajoute l'image au PDF
    pdf.addImage(imgData, 'PNG', 10, 10, canvasWidth, canvasHeight);

    // Enregistrez le PDF
    pdf.save(fileName + '.pdf');
}

    </script>
</body>

</html>