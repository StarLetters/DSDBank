document.getElementById('registration-form').addEventListener('submit', function(event) {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    

    if (password.value !== confirmPassword.value) {
        confirmPassword.textContent = "Les mots de passe ne correspondent pas.";

    //On indique l'erreur si les mots de passe ne correspondent pas
    confirmPassword.classList.add('form-control.is-invalid');
    confirmPassword.setCustomValidity("Les mots de passe ne correspondent pas.");
    event.preventDefault(); 
    }
});