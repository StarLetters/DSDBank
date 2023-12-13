const $button = document.querySelector('#sidebar-toggle');
const $wrapper = document.querySelector('#wrapper');
const $content = document.querySelector('#content');

$button.addEventListener('click', (e) => {
    e.preventDefault();
    $wrapper.classList.toggle('toggled');

    //  SOLUTION TEMPORAIRE
    if (screen.width < 990 && $wrapper.classList.contains('toggled')) {
        $content.style.display = "none";
    }else{
        $content.style.display = "block";
    }
});

if (screen.width > 990){
$wrapper.classList.toggle('toggled');
}