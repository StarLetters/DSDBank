<?php

// On récupère la raison sociale de l'utilisateur, et si il en a pas, (PO et admin) alors
// on prend son rôle.

function getDisplayName( $id, $cnx ) {
    $req = $cnx->prepare(
    'SELECT coalesce(e.raisonSociale, u.role) as displayName
    FROM Utilisateur u
    LEFT JOIN Entreprise e ON u.idUtilisateur = e.idUtilisateur
    WHERE u.idUtilisateur = :idUtilisateur');

    $req->bindParam(':idUtilisateur', $id);
    $req->execute();
    $displayName = $req->fetch();
    $req->closeCursor();
    return $displayName['displayName'] === "PO" ? "Responsable" : $displayName['displayName'];
}


?>