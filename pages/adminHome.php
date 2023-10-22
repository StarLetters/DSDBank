<?php

include('../account/verifLogin.php');
$role = verifLogin();
if ($role != 3) {
    header('Location: ../pages/welcome.php');
}	

include('../backend/cnx.php');






?>