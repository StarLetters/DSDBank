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

function getOnClickTable($role, $filename)
{
    $onclick = "";
    if ($role == 0) {
        if (isset($_SESSION['displayName'], $_SESSION['numSiren'])) {
            $filename .= strtoupper($_SESSION['displayName'] . ' ' .  'N SIREN ' . $_SESSION['numSiren']);
            $onclick = "exportTable('".$filename."')";
        } else {
            header('Location: ../index.html');
        }
    } else {
        $onclick = "exportTableWithName('".$filename."')";
    }
    return $onclick;
}

function getOnClickDetailledTable($role, $filename)
{
    $onclick = "";
    if ($role == 0) {
        if (isset($_SESSION['displayName'], $_SESSION['numSiren'])) {
            $filename .= strtoupper($_SESSION['displayName'] . ' ' .  'N SIREN ' . $_SESSION['numSiren']);
            $onclick = "exportDetailledTable('".$filename."')";
        } else {
            header('Location: ../index.html');
        }
    } else {
        $onclick = "exportDetailledTableWithName('".$filename."')";
    }
    return $onclick;
}   
