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
            <?php include('../includes/header.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Graphique à Barres</h3>
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="year">Sélectionnez l'année :</label>
                                <select id="year" class="form-control form-control-sm">
                                    <!-- années -->
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                </select>
                            </div>
                        </div>
                        <canvas id="barChart"></canvas>
                    </div>
                    <div class="col-md-12 mt-5">
                        <h3>Total de visites</h3>
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="monthsLine">Sélectionnez le mois :</label>
                                <select id="monthsLine" class="form-control form-control-sm">
                                    <option value="6">6 mois</option>
                                    <option value="12">12 mois</option>
                                    <option value="24">24 mois</option>
                                </select>
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
</body>

</html>