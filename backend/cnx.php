<?php
require_once 'config.php';
try {
    $cnx = new PDO(PDO_DATABASE, DATABASE_USER, DATABASE_PASSWORD); 
    echo "Connexion réussie"; 
}
catch (PDOException $e) {
    echo "ERREUR : La connexion a échouée";
    echo $e;
}
?>