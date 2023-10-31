<?php

session_start();

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 3) { // Si ce n'est pas un admin
    header('Location: ../pages/welcome.php');
}

<<<<<<< Updated upstream
if (isset($_SESSION['InscrSupp'])){
    $inscrsupp = $_SESSION['InscrSupp']; // Inscription ou Suppression
}
else {
    header('Location: ../pages/adminProfil.php');
}
=======
//if (!isset($_GET['InscrSupp'])){
 //   header('Location: ../pages/welcome.php');
//}

$inscrsupp = 'inscription';//$_GET['InscrSupp'];

echo 'huh';
print_r($_POST);
exit;

>>>>>>> Stashed changes

include('../backend/cnx.php');
$request = "SELECT * 
        FROM POrequete
        JOIN Utilisateur ON Utilisateur.email = POrequete.email
        WHERE type_requete = '".$inscrsupp."';";

$result = $cnx->prepare($request);
$result->execute();
$result = $result->fetchAll();

$cnx->beginTransaction();

foreach ($result as $row) {

    print_r($_POST);
    if (isset($_POST[$row['numSiren']])) {
        echo "yooo";
        exit;
        $requete = "DELETE FROM POrequete WHERE email = '" . $row['email'] . "';"; // Supprimer la demande
        $cnx->exec($requete);
        if (($inscrsupp == "suppression" && $_POST[$row['numSiren']] == "validate")|| ($inscrsupp == "inscription" && $_POST[$row['numSiren']] == "delete")){
            $requete = "DELETE FROM Entreprise WHERE idUtilisateur = '" . $row['idUtilisateur'] . "';";
            $cnx->exec($requete);
            $requete = "DELETE FROM Utilisateur WHERE idUtilisateur = '" . $row['idUtilisateur'] . "';";
            $cnx->exec($requete);
        }
    }
}
exit;
$cnx->commit();
<<<<<<< Updated upstream
header('Location: ../pages/adminProfil.php')
=======
header('Location: ../pages/adminHome.php');




function inscription($cnx){

}



>>>>>>> Stashed changes
?>
