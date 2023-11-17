<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PO Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/poProfile.css">
    <link rel="stylesheet" href="../css/varColor.css">
</head>

<body>
    <div class="">
        <div id="wrapper">
            <?php include('../includes/header.html'); ?>
            <div class="container">
                <div class="row">
                    <select id="chartType" class="form-control mt-3">
                        <option value="bar">Graphique à Barres</option>
                        <option value="line">Graphique à Courbes</option>
                    </select>

                    <div class="col-md-12 mt-5" id="barChartSection">
                        <h3>Graphique à Barres</h3>
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="startDate">Date de début :</label>
                                <input type="date" id="startDate" class="form-control form-control-sm">
                            </div>
                            <div class="col-auto">
                                <label for="endDate">Date de fin :</label>
                                <input type="date" id="endDate" class="form-control form-control-sm">
                            </div>                    
                        </div>
                        <canvas id="barChart"></canvas>
                        <button onclick="exportChartToPDF('barChart', 'graphique_barres')">Exporter en PDF</button>
                    </div>

                    <div class="col-md-12 mt-5" id="lineChartSection">
                        <h3>Total de visites</h3>
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="startDateLine">Date de début :</label>
                                <input type="date" id="startDateLine" class="form-control form-control-sm">
                            </div>
                            <div class="col-auto">
                                <label for="endDateLine">Date de fin :</label>
                                <input type="date" id="endDateLine" class="form-control form-control-sm">
                            </div>
                        </div>
                        <canvas id="lineChart"></canvas>
                    </div>

                </div>
            </div>

            <?php include('../includes/footer.html'); ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
    <script src="../scripts/graphic.js"></script>
    <script src="../scripts/button-nav.js"></script>
    <script src="../scripts/header.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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