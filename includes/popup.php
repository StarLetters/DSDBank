<?php
function displayPopup(){
    $popupClass = isset($_SESSION['popupType']) ? $_SESSION['popupType'] : ''; 
    $popupMessage = isset($_SESSION['popupMessage']) ? $_SESSION['popupMessage'] : '';

    // Vérifie si une popup doit être affichée 
    if (!empty($popupClass) && !empty($popupMessage)){
            echo    
            "<div class='popup ".$popupClass."'>
                <span class='popup-message'>".$popupMessage."</span>
            </div>";
    }

    echo '<link rel="stylesheet" type="text/css" media="screen" href="../css/popup.css" />
          <script defer src="../scripts/popup.js"></script>';

    // Vide les variables de session après récupération
    unset($_SESSION['popupType']);
    unset($_SESSION['popupMessage']);
}

// 0 = error, 1 = success
function setPopup(int $type, string $message){
    $_SESSION['popupType'] = $type ? 'success' : 'error';
    $_SESSION['popupMessage'] = $message;
}
?>