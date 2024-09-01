
function validateForm() {
    var inputs = document.getElementsByTagName('input');
    var valid = true;
    // Expressions régulières pour la validation
    var regex = {
        first_name: /^[a-zA-Z\s]{2,}$/,
        last_name: /^[a-zA-Z\s]{2,}$/,
        email: /^\w+([-+.']\w+)*@\w+.[a-zA-Z]{2,4}$/, 
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