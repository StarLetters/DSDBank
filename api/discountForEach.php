<?php
include('../backend/cnx.php');

include('../api/utilities.php');

function getDiscount($token, $num, $filter, $email, $order, $startDate, $endDate)
{
    global $cnx;
    $request = "SELECT 
    Entreprise.numSiren AS `N° SIREN`, 
    Entreprise.raisonSociale AS `Raison sociale`,
    Transaction.numRemise AS `N° Remise`,
    dateRemise AS `Date de traitement`,
    COUNT(*) AS `Nombre de remises`,
    Transaction.devise,
    SUM(
      CASE 
        WHEN Transaction.sens = '-' THEN -Transaction.montant
        ELSE Transaction.montant
      END
    ) AS `Montant total`
  FROM 
    Transaction 
  JOIN 
    Entreprise ON Entreprise.idUtilisateur = Transaction.idUtilisateur
  JOIN
    Utilisateur ON Utilisateur.idUtilisateur = Entreprise.idUtilisateur
  JOIN
    Remise ON Remise.numRemise = Transaction.numRemise
  WHERE Utilisateur.idUtilisateur = Entreprise.idUtilisateur";
    if ($token !== null) {
        $request .= " AND Transaction.idUtilisateur IN (
            SELECT DISTINCT tra.idUtilisateur
            FROM Transaction tra, Token tok, Utilisateur uti
            WHERE tra.idUtilisateur = uti.idUtilisateur
            AND uti.email = tok.email
            AND tok.token = :token)";
    } else {
        if ($num !== null && $filter !== null) {
            if ($filter == 0) {
                $request .= " AND Entreprise.numSiren = :numSiren";
            } else if ($filter == 1) {
                $request .= " AND Transaction.numRemise = :numRemise";
            }
        }
        if ($email !== null) {
            $request .= " AND Utilisateur.email = :email";
        } 
        if ($startDate !== null) {
          $request .= " AND dateRemise >= :startDate";
        }
        if ($endDate !== null) {
          $request .= " AND dateRemise <= :endDate";
        }
    }
    $request .=" GROUP BY 
    Entreprise.numSiren, Entreprise.raisonSociale, Transaction.devise, Transaction.numRemise, dateRemise";

    // Ajout OrderBy
    if ($order !== null) {
        if ($order == "montantDesc") {
            $order = "`Montant total` desc";
        } else if ($order == "montantAsc") {
          $order = "`Montant total` asc";
        }
    } else {
        $order = "Transaction.numRemise asc";
    }
    $request .= " ORDER BY $order;";

    $result = $cnx->prepare($request);
    if ($token !== null) {
        $result->bindParam(":token", $token);
    } 

    if ($num !== null && $filter !== null) {
        if ($filter == 0) {
            $result->bindParam(":numSiren", $num);
        } else if ($filter == 1) {
            $result->bindParam(":numRemise", $num);
        }
    }

    if ($email !== null) {
        $result->bindParam(":email", $email);
    }

    if ($startDate !== null) {
        $result->bindParam(":startDate", $startDate);
    }

    if ($endDate !== null) {
        $result->bindParam(":endDate", $endDate);
    }

    $result->execute();
    $result = $result->fetchAll();
    return $result;
}


// Pas autorisé ici
if (empty($_GET) || $_GET['token'] == "null") {
  
    header('Location: ../index.html');
    exit;
}

$token = htmlspecialchars($_GET['token']);
$role = verifRole($token);
$num = null;
$email = null;

$order = isset($_GET['order']) ? htmlspecialchars($_GET['order']) : null;
$startDate = isset($_GET['startDate']) ? htmlspecialchars($_GET['startDate']) : null;
$endDate = isset($_GET['endDate']) ? htmlspecialchars($_GET['endDate']) : null;

if ($role == 1){
    if (isset($_GET['nSiren'])) {
        $num = htmlspecialchars($_GET['nSiren']);
        $filter = 0;
    } else {
        $num = isset($_GET['nRemise']) ? htmlspecialchars($_GET['nRemise']) : null;
        $filter = 1;
    }
    $token = null;
} else if ($role == 0) {
    $num = isset($_GET['nRemise']) ? htmlspecialchars($_GET['nRemise']) : null;
    $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : null;
    $filter = 1;
    $token = null;
}
$result = getDiscount($token, $num, $filter, $email, $order, $startDate, $endDate);
outputJson($result);
?>