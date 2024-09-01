
<head>
<?php include('../inc/headAdmin.inc.php'); ?>
<?php include('../inc/header1.inc.php'); ?>
<body>

<div class=" ">
    <div class="partie3">
    <h1 class="my-3 p-1 ">Connexion</h1>
    <form class="mw-900 m-auto p-1 " action="../Controllers/CRUDPractitioner.controller.php" method="POST" onsubmit="return validateForm()">
        <input type="hidden" name="action" value="login">
        <div class="form-group">
            <label class="form-label" for="email">Email:</label>
            <input class="form-input" type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Mot de passe:</label>
            <input class="form-input" type="password" id="password" name="password" required>
        </div>
        <div class="d-flex jc-se my-3">
            <button class="ast-button" type="submit">Se connecter</button><a class="button" href="../index.php">Annuler</a>
        </div>
    </form>
    
</div>
<script>
        // Fonction de validation des champs avec des expressions régulières
        function validateForm() {
            var inputs = document.getElementsByTagName('input');
            var valid = true;

            // Expressions régulières pour la validation
            var regex = {
                first_name: /^[a-zA-Z\s]+$/,
                last_name: /^[a-zA-Z\s]+$/,
                email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                phone: /^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/
            };

            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i];

                // Vérification de chaque champ selon son ID
                if (regex[input.id] && !regex[input.id].test(input.value)) {
                    input.style.borderColor = 'red';
                    valid = false;
                } else {
                    input.style.borderColor = 'green';
                }

                // Vérification des champs vides
                if (input.value.trim() === '') {
                    input.style.borderColor = 'red';
                    valid = false;
                }
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
    <?php include('../inc/footerAdmin.inc.php'); ?>