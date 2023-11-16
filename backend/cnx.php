<?php
require_once 'config.php';
try {
    $cnx = new PDO(PDO_DATABASE, DATABASE_USER, DATABASE_PASSWORD);
}
catch (PDOException $e) {
    echo $e;
    echo "\n\n\n\n\nProblème de connexion";
    exit;
}
?>