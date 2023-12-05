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
    <title>Recherche de remise</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/varColor.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/impayes.css">
    <link rel="stylesheet" href="../css/tresorerie.css">
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
                        <h1 class="mt-5">Recherche de remise</h1>
                    </div>
                </div>
                <div>
                    <?php
                    if ($role == 1) {
                        echo "
                    <label for=\"nRemise\">N° Remise :</label>
                    <input type=\"text\" id=\"nRemise\" class=\"form-control form-control-sm date\">
                    
                    
                    <button id=\"resetButton\">Effacer</button>
                    <button id=\"searchButton\">Rechercher</button>";
                    }
                    ?>
                </div>
                <div>
                    <div id="items-per-page-container" class="mx-3">
                        <label for="items-per-page">Éléments par page:</label>
                        <select id="items-per-page" class="item-selecteur">
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div id="results-container" class="text-right"></div>
                    <div id="table-container"></div>
                    <nav id="pagination-container"></nav>

                </div>
                <?php include('../includes/footer.html'); ?>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

        <script defer type="module" src="../scripts/discount.js"></script>

        <script src="../scripts/header.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

</body>

</html>