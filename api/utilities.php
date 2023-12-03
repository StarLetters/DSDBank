<?php
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

function outputJson($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
}

?>