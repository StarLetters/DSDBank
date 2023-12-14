const popup = document.querySelector('.popup');
if (popup !== null){
    popup.style.display = 'block';

    // Ferme le popup après un délai (par exemple, 3 secondes)
    setTimeout(function () {
        popup.style.display = 'none';
    }, 6000);
}