<?php include('../inc/headAdmin.inc.php'); ?>
<?php include('../inc/header1.inc.php'); ?>
<body>
    <div class="">
        <!-- <div class="my-3 d-flex jc-c mh-300">
            <h1 class="my-3">Page d'inscription</h1>
        </div> -->
        <div class="partie3  ">
            <form id="mon-formulaire" class="mw-900 m-auto my-3 p-1" action="../Controllers/CRUDPractitioner.controller.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                <h1 class="my-3">S'inscrire</h1>
                    <input type="hidden" name="action" value="create">

                    <div class="form-group">
                        <label class="form-label" for="first_name">Prénom:</label>
                        <input class="form-input" type="text" id="first_name" name="first_name">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="last_name">Nom:</label>
                        <input class="form-input" type="text" id="last_name" name="last_name">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email:</label>
                        <input class="form-input" type="email" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phone">Téléphone:</label>
                        <input class="form-input" type="text" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="demande">Demande:</label>
                        <textarea class="form-input" id="demande" name="demande"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Mot de passe:</label>
                        <input class="form-input" type="password" id="password" name="password">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="confirm_password">Confirmation du mot de passe:</label>
                        <input class="form-input" type="password" id="confirm_password" name="confirm_password">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kbis">Kbis:</label>
                        <input class="form-file" type="file" id="kbis" name="kbis" >
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="attestation_assurance">Attestation d'assurance:</label>
                        <input class="form-file" type="file" id="attestation_assurance" name="attestation_assurance" >
                    </div>

                    <div class="d-flex jc-se my-3">
                        <button type="submit">S'inscrire</button>
                        <a href="../index.php" class="button">Annuler</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    </div>
    <script>
 // Fonction de validation des champs avec des expressions régulières
function validateForm() {
    var inputs = document.getElementsByTagName('input');
    var valid = true;
    // Expressions régulières pour la validation
    var regex = {
        first_name: /^[a-zA-Z\s]{2,50}$/,
        last_name: /^[a-zA-Z\s]{2,50}$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        phone: /^\d{10}$/,
        password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(?=.*[0-9]).{8,}$/
    };
    var passwordInput = document.getElementById('password');
    var confirmPasswordInput = document.getElementById('confirm_password');
    for (var i = 0; i < inputs.length; i++) {
        var input = inputs[i];
        // Vérification de chaque champ selon son ID
        if (regex[input.id] && !regex[input.id].test(input.value)) {
            input.style.borderColor = 'red';
            valid = false;
            // Affichage d'une alerte spécifique à chaque erreur
            switch (input.id) {
                case 'first_name': alert('Le prénom doit contenir uniquement des lettres et avoir entre 2 et 50 caractères.');
                    break;
                case 'last_name': alert('Le nom de famille doit contenir uniquement des lettres et avoir entre 2 et 50 caractères.');
                    break;
                case 'email': alert('L\'adresse e-mail doit être au format valide (exemple@domaine.com).');
                    break;
                case 'phone': alert('Le numéro de téléphone doit contenir 10 chiffres.');
                    break;
                case 'password':
alert('Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un caractère spécial, un chiffre et avoir une longueur d\'au moins 8 caractères.');
                    break;
                default:
                    alert('Veuillez remplir tous les champs requis.');
                    break;
            }
        } else {
            input.style.borderColor = 'green';
        }
        // Vérification des champs vides
        if (input.value.trim() === '') {
            input.style.borderColor = 'red';
            valid = false;        
        }
    }
    // Vérification de la correspondance des mots de passe
    if (passwordInput.value !== confirmPasswordInput.value) {
        passwordInput.style.borderColor = 'red';
        confirmPasswordInput.style.borderColor = 'red';
        valid = false;
        alert('Le mot de passe et la confirmation du mot de passe ne correspondent pas.');
    }
    return valid;
}
// Ajout de l'événement de soumission du formulaire pour appeler la fonction de validation
var form = document.getElementById('mon-formulaire');
form.addEventListener('submit', function(event) {
    if (!validateForm()) {
        event.preventDefault(); // Empêche l'envoi du formulaire si des champs sont invalides
    }
});

    </script>
    <div "><?php include('../inc/footerAdmin.inc.php'); ?></div>
</body>