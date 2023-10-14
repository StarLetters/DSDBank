// Cette fonction permet de basculer la visibilité du mot de passe dans un champ de saisie.
const togglePasswordVisibility = (icon) => {
    // ça obtient le champ de saisie de mot de passe
    const passwordInput = icon.previousElementSibling;

    // ça vérifie le type actuel du champ de saisie.
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordInput.classList.add("active");
    } else {
        passwordInput.type = "password";
        passwordInput.classList.remove("active");
    }
}
