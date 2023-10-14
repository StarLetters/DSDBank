// Cette fonction s'exécute immédiatement dès le chargement complet de la page.
// ça sert pour le form pour les validations et pour que ça soit plus rapide lors de la validation
(
  function() {
      // ça attache un gestionnaire d'événements à l'événement "load" de la fenêtre du navigateur
      window.addEventListener('load', function() {
          // ça récupère tous les éléments du form
          var forms = document.getElementsByClassName('needs-validation');

          // Utilise la méthode filter pour itérer à travers les formulaires et ajouter des validations
          var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                  // Vérifie si le formulaire n'est pas valide.
                  if (form.checkValidity() === false) {
                      // Empêche l'envoi du formulaire.
                      event.preventDefault();
                      // Empêche la propagation de l'événement de soumission.
                      event.stopPropagation();
                  }
                  // Ajoute la classe "was-validated" au formulaire pour indiquer qu'il a été validé
                  form.classList.add('was-validated');
              }, false);
          });
      }, false);
  }
)();
