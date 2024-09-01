
    function validateForm() {
        // Récupérer les valeurs des champs du formulaire
        var firstName = document.getElementById('first-name').value;
        var lastName = document.getElementById('last-name').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        
        // Vérifier les champs individuellement
        if (firstName === '') {
            alert('Veuillez saisir votre prénom');
            return false;
        }
        
        if (lastName === '') {
            alert('Veuillez saisir votre nom');
            return false;
        }
        
        if (email === '') {
            alert('Veuillez saisir votre adresse e-mail');
            return false;
        } else if (!validateEmail(email)) {
            alert('Veuillez saisir une adresse e-mail valide');
            return false;
        }
        
        if (phone === '') {
            alert('Veuillez saisir votre numéro de téléphone');
            return false;
        } else if (!validatePhone(phone)) {
            alert('Veuillez saisir un numéro de téléphone valide');
            return false;
        }
        
        // Tous les champs sont valides, soumettre le formulaire
        alert('Formulaire soumis avec succès');
        return true;
    }
    
    // Fonction pour valider l'adresse e-mail
    function validateEmail(email) {
        // Utilisez une expression régulière pour valider l'adresse e-mail
        var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        return emailRegex.test(email);
    }
    
    // Fonction pour valider le numéro de téléphone
    function validatePhone(phone) {
        // Utilisez une expression régulière pour valider le numéro de téléphone
        var phoneRegex = /^[0-9]{10}$/;
        return phoneRegex.test(phone);
    }


    function submitForm(action) {
        if (action === 'profil') {
            document.getElementById('profilAction').value = action;
        } else if (action === 'reservations') {
            document.getElementById('reservationsAction').value = action;
        }
    
        document.getElementById('dropdownForm').submit();
    }
    