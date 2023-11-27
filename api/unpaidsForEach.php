<?php
include('../backend/cnx.php');

function verifRole($token)
{
    global $cnx;
    $request = "SELECT * FROM Token WHERE token = :token AND type = 'connexion';";
    $result = $cnx->prepare($request);
    $result->bindParam(':token', $token);
    $result->execute();
    $result = $result->fetchAll();
    if (empty($result)) {
        header('Location: ../pages/welcome.php');
        return 0;
    }
    if ($result[0]['email'] == "po@gmail.com") {
        return 1;
    } else if ($result[0]['email'] == "elae.dsd@gmail.com") {
        return 2;
    } else {
        return 0;
    }
}

function getUnpaidsClient($token, $nImp = null, $leftBound = null, $rightBound = null, $orderby = null)
{
    global $cnx;
    $request =
        "SELECT Entreprise.numSiren as N°SIREN, Transaction.dateVente, IFNULL(Remise.dateRemise,'" . "Pas encore" . "') as dateRemise, ClientFinal.numCarteClient as N°Carte, ClientFinal.reseauClient, Impaye.numDossierImpaye as N°DossierImpaye, Transaction.devise, Transaction.montant, Transaction.sens, Impaye.libelleImpaye FROM Impaye
        LEFT JOIN Transaction ON Impaye.idTransaction = Transaction.idTransaction
        LEFT JOIN Utilisateur ON Utilisateur.idUtilisateur = Transaction.idUtilisateur
        LEFT JOIN ClientFinal ON ClientFinal.idClient = Transaction.idClient
        LEFT JOIN Entreprise ON Entreprise.idUtilisateur = Transaction.idUtilisateur
        LEFT JOIN Remise ON Remise.numRemise = Transaction.numRemise
        WHERE Transaction.idUtilisateur IN (
            SELECT DISTINCT tra.idUtilisateur
            FROM Transaction tra, Token tok, Utilisateur uti
            WHERE tra.idUtilisateur = uti.idUtilisateur
            AND uti.email = tok.email
            AND tok.token = :token) ";

    if ($nImp !== null) {
        $request .= "AND Impaye.numDossierImpaye = :nImp ";
    }

    if ($leftBound !== null) {
        $request .= "AND Transaction.dateVente >= :leftBound ";
    }

    if ($rightBound !== null) {
        $request .= "AND Transaction.dateVente <= :rightBound ";
    }

    if ($orderby !== null) {
        $request .= "ORDER BY :orderby";
    }

    $request .= ";";

    $result = $cnx->prepare($request);
    $result->bindParam(":token", $token);

    if ($nImp !== null) {
        $result->bindParam(":nImp", $nImp);
    }

    if ($leftBound !== null) {
        $result->bindParam(":leftBound", $leftBound);
    }

    if ($rightBound !== null) {
        $result->bindParam(":rightBound", $rightBound);
    }

    if ($orderby !== null) {
        $result->bindParam(":orderby", $orderby);
    }

    $result->execute();
    $result = $result->fetchAll();
    return $result;
}
function getUnpaidsPO($token, $nImp = null, $leftBound = null, $rightBound = null, $orderby = null, $nSiren = null, $raisonSociale = null)
{
    global $cnx;
    if ($nSiren == null && $raisonSociale == null && $nImp == null) {
        $request = "SELECT Entreprise.numSiren, SUM(Transaction.montant) as \"Somme Impayés\" FROM Impaye
        JOIN Transaction ON Transaction.idTransaction = Impaye.idTransaction
        JOIN Entreprise ON Entreprise.idUtilisateur = Transaction.idUtilisateur
        GROUP BY Entreprise.numSiren 
        ";
        if ($orderby !== null) {
            $request .= "ORDER BY :orderby";
        }
        $request .= ";";
        $result = $cnx->prepare($request);
        if ($orderby !== null) {
            if ($orderby == "montant desc") {
               $orderby = "SUM(Transaction.montant) desc";
            } 
            $result->bindParam(":orderby", $orderby);
        }
    } else {
        $request =
            "SELECT Entreprise.numSiren as N°SIREN, Transaction.dateVente, IFNULL(Remise.dateRemise,'" . "Pas encore" . "') as dateRemise, ClientFinal.numCarteClient as N°Carte, ClientFinal.reseauClient, Impaye.numDossierImpaye as N°DossierImpaye, Transaction.devise, Transaction.montant, Transaction.sens, Impaye.libelleImpaye FROM Impaye
        LEFT JOIN Transaction ON Impaye.idTransaction = Transaction.idTransaction
        LEFT JOIN Utilisateur ON Utilisateur.idUtilisateur = Transaction.idUtilisateur
        LEFT JOIN ClientFinal ON ClientFinal.idClient = Transaction.idClient
        LEFT JOIN Entreprise ON Entreprise.idUtilisateur = Transaction.idUtilisateur
        LEFT JOIN Remise ON Remise.numRemise = Transaction.numRemise
        WHERE 0=0 ";

        if ($nImp !== null) {
            $request .= "AND Impaye.numDossierImpaye = :nImp ";
        }

        if ($leftBound !== null) {
            $request .= "AND Transaction.dateVente >= :leftBound ";
        }

        if ($rightBound !== null) {
            $request .= "AND Transaction.dateVente <= :rightBound ";
        }

        if ($nSiren !== null) {
            $request .= "AND Entreprise.numSiren = :nSiren ";
        }

        if ($raisonSociale !== null) {
            $request .= "AND Entreprise.raisonSociale = :raisonSociale ";
        }

        if ($orderby !== null) {
            $request .= "ORDER BY :orderby";
        }

        $request .= ";";
        $result = $cnx->prepare($request);
        if ($nImp !== null) {
            $result->bindParam(":nImp", $nImp);
        }

        if ($leftBound !== null) {
            $result->bindParam(":leftBound", $leftBound);
        }

        if ($rightBound !== null) {
            $result->bindParam(":rightBound", $rightBound);
        }

        if ($orderby !== null) {
            $result->bindParam(":orderby", $orderby);
        }

        if ($nSiren !== null) {
            $result->bindParam(":nSiren", $nSiren);
        }

        if ($raisonSociale !== null) {
            $result->bindParam(":raisonSociale", $raisonSociale);
        }
    }

    $result->execute();
    $result = $result->fetchAll();
    return $result;
}

function outputJson($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
}


// Pas autorisé ici
if (empty($_GET) || $_GET['token'] == "null") {
    header('Location: ' . $location);
    exit;
}

$token = htmlspecialchars($_GET['token']);
$role = verifRole($token);

$nImp = isset($_GET['nImp']) ? htmlspecialchars($_GET['nImp']) : null;
$leftBound = isset($_GET['leftBound']) ? htmlspecialchars($_GET['leftBound']) : null;
$rightBound = isset($_GET['rightBound']) ? htmlspecialchars($_GET['rightBound']) : null;
$orderby = isset($_GET['orderby']) ? htmlspecialchars($_GET['orderby']) : null;

if ($role == 1) {
    $nSiren = isset($_GET['nSIREN']) ? htmlspecialchars($_GET['nSIREN']) : null;
    $raisonSociale = isset($_GET['raisonSociale']) ? htmlspecialchars($_GET['raisonSociale']) : null;
    $result = getUnpaidsPO($token, $nImp, $leftBound, $rightBound, $orderby, $nSiren, $raisonSociale);
} else {
    $result = getUnpaidsClient($token, $nImp, $leftBound, $rightBound, $orderby);
}
outputJson($result);
