const $button = document.querySelector('#sidebar-toggle');
const $wrapper = document.querySelector('#wrapper');
const $content = document.querySelector('#content');

$button.addEventListener('click', (e) => {
    e.preventDefault();
    $wrapper.classList.toggle('toggled');
});

if (screen.width > 990){
$wrapper.classList.toggle('toggled');
}

const navbar = document.getElementById("navbar-wrapper");
document.addEventListener('click', function(event) {
    if (!navbar.contains(event.target) && !$wrapper.classList.contains('navbar-toggle') && screen.width < 990) {
        $wrapper.classList.remove('toggled');
    }
});