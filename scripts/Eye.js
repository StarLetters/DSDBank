const togglePasswordVisibility = (icon) => {
    const passwordInput = icon.previousElementSibling;

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordInput.classList.add("active");
    } else {
        passwordInput.type = "password";
        passwordInput.classList.remove("active"); 
    }
}