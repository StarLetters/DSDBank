<?php
function getOnclick($role, $filename, $typechart, $width, $height)
{
    $onclick = "";
    if ($role == 0) {
        if (isset($_SESSION['displayName'], $_SESSION['numSiren'])) {
            $filename .= strtoupper($_SESSION['displayName'] . ' ' .  'N SIREN ' . $_SESSION['numSiren']);
            $onclick = "exportChartToPDF('".$typechart."', '" . addslashes($filename) . "' , 'pdf',".$width.", ".$height.")";
        } else {
            header('Location: ../index.html');
        }
    } else {
        $onclick = "exportChartToPDFWithTitle('".$typechart."', '" . addslashes($filename) . "' , 'pdf',".$width.", ".$height.")";
    }
    return $onclick;
}
