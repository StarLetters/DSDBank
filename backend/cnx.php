<?php
require_once 'config.php';
try {
    $cnx = new PDO(PDO_DATABASE, DATABASE_USER, DATABASE_PASSWORD); 
}
catch (PDOException $e) {
    echo $e;
}
?>