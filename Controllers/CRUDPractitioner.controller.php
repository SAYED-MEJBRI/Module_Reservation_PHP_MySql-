<?php
 if (session_status() === PHP_SESSION_NONE) {
    session_start();
 
}
// Inclusion de la classe Practitioner
require_once '../models/Practitioner.php';
if (isset($_POST["action"])) {
    $action = $_POST["action"];
    if ($action == "logout") {



        // Détruire la session
        session_destroy();
        $_SESSION["isLoggedIn"] = false;
      
     
        // Rediriger vers la page de connexion ou toute autre page souhaitée
        header("Location: ../index.php");
        exit();
    }
    if ($action == "logoutAdmin") {



        // Détruire la session
        session_destroy();
        $_SESSION["isLoggedIn"] = false;
      
     
        // Rediriger vers la page de connexion ou toute autre page souhaitée
        header("Location: ../index.php");
        exit();
    }
    if ($action == "profil") {
        // require_once '../models/Practitioner.php';
        $id = $_POST['prat_id'];


        $pratitioner = new Practitioner();
        $profil = $practitioner->getProfileByID($id);
        var_dump($profil);
        die();
    }
    if ($action === 'create') {
        // Récupérer les données du formulaire
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $demande = $_POST['demande'];
        $kbis = $_FILES['kbis'];
        $attestation_assurance = $_FILES['attestation_assurance'];
        
        // Effectuer les tests nécessaires sur les données
        $errors = [];
        
        // Vérifier la longueur des champs
        if (strlen($first_name) < 2 || strlen($first_name) > 50) {
            $errors[] = "Le prénom doit contenir entre 2 et 50 caractères.";
        }  
        if (strlen($last_name) < 2 || strlen($last_name) > 50) {
            $errors[] = "Le nom doit contenir entre 2 et 50 caractères.";
        } 
        if (strlen($phone) !== 10) {
            $errors[] = "Le numéro de téléphone doit contenir exactement 10 chiffres.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse email n'est pas valide.";
        // Vérifier si le numéro de téléphone contient uniquement des chiffres
        if (!ctype_digit($phone)) {
            $errors[] = "Le numéro de téléphone ne doit contenir que des chiffres.";
        }
        // Vérifier si le mot de passe et la confirmation du mot de passe sont identiques
        if ($password !== $confirm_password) {
            $errors[] = "Le mot de passe et la confirmation du mot de passe ne correspondent pas.";
        }
        
        // Si des erreurs sont détectées, afficher les messages d'erreur
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        } else {
            // Toutes les vérifications sont passées, appeler la fonction createPractitioner()
            $practitioner = new Practitioner();
            $success = $practitioner->addPractitioner($first_name, $last_name, $email, $phone, $password, $demande, $kbis, $attestation_assurance);
        
            if ($success) {
                // Créer un dossier avec le nom et le prénom du praticien dans le répertoire "img_pratisionner"
                $directory = "../assets/img/documents_pratisionner/";
                $practitionerFolder = $directory . $first_name . "_" . $last_name . "/";
        
                // Vérifier si le dossier existe déjà
                if (!file_exists($practitionerFolder)) {
                    // Créer le dossier
                    mkdir($practitionerFolder, 0777, true);
                }
        
                // Déplacer les fichiers téléchargés dans le dossier du praticien
                $kbisPath = $practitionerFolder . $kbis['name'];
                move_uploaded_file($kbis['tmp_name'], $kbisPath);
        
                $attestationPath = $practitionerFolder . $attestation_assurance['name'];
                move_uploaded_file($attestation_assurance['tmp_name'], $attestationPath);
        
                echo "Praticien créé avec succès.";
                header('location:../index.php');
                exit();
            } else {
                echo "Erreur lors de la création du praticien.";
            }
        }
        
    }}
    if ($action === 'update') {
        // Récupérer l'ID du praticien à mettre à jour
        $practitionerId = $_POST['practitioner_id'];

        // Vérifier si l'ID du praticien est valide (vous pouvez ajouter des validations supplémentaires si nécessaire)
        if (!empty($practitionerId)) {
            // Récupérer les données du formulaire
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $demande = $_POST['demande'];
            $Nkbis = $_FILES['Nkbis'];
            $Nattestation_assurance = $_FILES['Nattestation_assurance'];
            $attestation_assurance=$_POST['attestation_assurance'];
            $kbis=$_POST['kbis'];

            // Effectuer les tests nécessaires sur les données
            $errors = [];

            // Vérifier la longueur des champs
            if (strlen($first_name) < 2 || strlen($first_name) > 50) {
                $errors[] = "Le prénom doit contenir entre 2 et 50 caractères.";
            }

            if (strlen($last_name) < 2 || strlen($last_name) > 50) {
                $errors[] = "Le nom doit contenir entre 2 et 50 caractères.";
            }

            // ... Autres validations ...

            // Si des erreurs sont détectées, afficher les messages d'erreur
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
            } else {
                // Toutes les vérifications sont passées, appeler la fonction updatePractitioner()
                $practitioner = new Practitioner();
                $success = $practitioner->updatePractitioner($practitionerId, $first_name, $last_name, $email, $phone, $demande);

                if ($success) {
                    // Vérifier si un nouveau fichier Kbis a été téléchargé
                    
                    if (!empty($kbis['tmp_name'])) {
                        // Créer un dossier avec le nom et le prénom du praticien dans le répertoire "img_pratisionner"
                        $directory = "../assets/img/documents_pratisionner/";
                        $practitionerFolder = $directory . $first_name . "_" . $last_name . "/";

                        // Vérifier si le dossier existe déjà
                        if (!file_exists($practitionerFolder)) {
                            // Créer le dossier
                            mkdir($practitionerFolder, 0777, true);
                        }

                        // Déplacer le nouveau fichier Kbis dans le dossier du praticien
                        $kbisPath = $practitionerFolder . $kbis['name'];
                        move_uploaded_file($kbis['tmp_name'], $kbisPath);
                    }

                    // Vérifier si une nouvelle attestation d'assurance a été téléchargée
                    if (!empty($attestation_assurance['tmp_name'])) {
                        // Créer un dossier avec le nom et le prénom du praticien dans le répertoire "img_pratisionner"
                        $directory = "../assets/img/documents_pratisionner/";
                        $practitionerFolder = $directory . $first_name . "_" . $last_name . "/";

                        // Vérifier si le dossier
                        // Vérifier si le dossier existe déjà
                        if (!file_exists($practitionerFolder)) {
                            // Créer le dossier
                            mkdir($practitionerFolder, 0777, true);
                        }

                        // Déplacer la nouvelle attestation d'assurance dans le dossier du praticien
                        $attestationPath = $practitionerFolder . $attestation_assurance['name'];
                        move_uploaded_file($attestation_assurance['tmp_name'], $attestationPath);
                    }

                    echo "Praticien mis à jour avec succès.";
                    header('location:../Views/displayPractitioners.view.php');
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour du praticien.";
                }
            }
        }
    }
    if ($action === 'affiche') {
        // Récupérer l'ID du praticien à afficher
        $practitionerId = $_POST['practitioner_id'];

        // Vérifier si l'ID du praticien est valide (vous pouvez ajouter des validations supplémentaires si nécessaire)
        if (!empty($practitionerId)) {
            // Appeler la fonction getById() pour récupérer les informations du praticien
            $practitioner = new Practitioner();
            $practitionerData = $practitioner->getProfilById($practitionerId);

            // Vérifier si le praticien a été trouvé
            if ($practitionerData) {
                // Rediriger vers la vue en incluant $practitionerData en tant que paramètre de requête GET
                header('Location: ../Views/updatePractitioner.view.php?practitionerData=' . urlencode(serialize($practitionerData)));
                exit();
            } else {
                // Message d'erreur
                $message = 'Une erreur est survenue lors de la modification des salles.';
            }
        }
    }
    if ($action === 'deleteAll') {
        // Supprimer tous les praticiens de la base de données
        $practitioner = new Practitioner();
        $success = $practitioner->deleteAllPractitioners();


        header('location:../Views/displayPractitioners.view.php');
    }
    if ($action == "login") {
        // Récupérer les données du formulaire
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Créer une instance du modèle Practitioner
        // $practitioner = new Practitioner('','','',$email,'','',$password,'','');
        $practitioner = new Practitioner();
        // Rechercher le praticien par email
        $foundPractitioner = $practitioner->searchPractitionerByEmail($email);

        // Vérifier si le praticien a été trouvé et si le mot de passe correspond

        if ($foundPractitioner && $practitioner->verifyPassword($password)) {
            // Démarrer la session
            session_start();
            // 
            // Définir les variables de session
            $_SESSION["first_name"] = $practitioner->getFirstName();

            $_SESSION["last_name"] = $practitioner->getLastName();
            $_SESSION["prat_id"] = $practitioner->getPractitionerId();
            $_SESSION["isLoggedIn"] = true;
            
         if($email==='admin@yahoo.fr'){
            header("Location: ../Views/indexAdmin.php");
            $_SESSION["status"] = "user";
            exit();
         }else{
            header("Location: ../index.php");
            $_SESSION["status"] = "Admin";
            exit();
        }
        } else {
            // Le praticien n'a pas été trouvé ou le mot de passe est incorrect
            echo "Email ou mot de passe incorrect";

            // Afficher l'erreur sur la page de connexion
            // ...
        }
    }
    if ($action === 'deleteById') {
           
            $practitionerId = $_POST['practitioner_id'];
    
            // Supprimer le praticien de la base de données par son ID
            $practitioner = new Practitioner();
            $success = $practitioner->deletePractitionerById($practitionerId);
    
            if ($success) {
               
              
                    // Rediriger vers la page d'affichage des praticiens avec un message de succès
                    header('Location: ../Views/displayPractitioners.view.php?success=1');
                } 
    }  
    if ($action === 'createAdmin') {
        

        // Récupérer les données du formulaire
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $demande = $_POST['demande'];
        $kbis = $_FILES['kbis'];
        $attestation_assurance = $_FILES['attestation_assurance'];
        
        // Effectuer les tests nécessaires sur les données
        $errors = [];
        
        // Vérifier la longueur des champs
        if (strlen($first_name) < 2 || strlen($first_name) > 50) {
            $errors[] = "Le prénom doit contenir entre 2 et 50 caractères.";
        }
        
        if (strlen($last_name) < 2 || strlen($last_name) > 50) {
            $errors[] = "Le nom doit contenir entre 2 et 50 caractères.";
        }
        
        if (strlen($phone) !== 10) {
            $errors[] = "Le numéro de téléphone doit contenir exactement 10 chiffres.";
        }
        
        // Vérifier si l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse email n'est pas valide.";
        }
        
        // Vérifier si le numéro de téléphone contient uniquement des chiffres
        if (!ctype_digit($phone)) {
            $errors[] = "Le numéro de téléphone ne doit contenir que des chiffres.";
        }
        
        // Vérifier si le mot de passe et la confirmation du mot de passe sont identiques
        if ($password !== $confirm_password) {
            $errors[] = "Le mot de passe et la confirmation du mot de passe ne correspondent pas.";
        }
        
        // Si des erreurs sont détectées, afficher les messages d'erreur
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        } else {
            // Toutes les vérifications sont passées, appeler la fonction createPractitioner()
            $practitioner = new Practitioner();
            $success = $practitioner->addPractitioner($first_name, $last_name, $email, $phone, $password, $demande, $kbis, $attestation_assurance);
        
            if ($success) {
                // Créer un dossier avec le nom et le prénom du praticien dans le répertoire "img_pratisionner"
                $directory = "../assets/img/documents_pratisionner/";
                $practitionerFolder = $directory . $first_name . "_" . $last_name . "/";
        
                // Vérifier si le dossier existe déjà
                if (!file_exists($practitionerFolder)) {
                    // Créer le dossier
                    mkdir($practitionerFolder, 0777, true);
                }
        
                // Déplacer les fichiers téléchargés dans le dossier du praticien
                $kbisPath = $practitionerFolder . $kbis['name'];
                move_uploaded_file($kbis['tmp_name'], $kbisPath);
        
                $attestationPath = $practitionerFolder . $attestation_assurance['name'];
                move_uploaded_file($attestation_assurance['tmp_name'], $attestationPath);
        
                echo "Praticien créé avec succès.";
                header('location:../Views/indexAdmin.php');
                exit();
            } else {
                echo "Erreur lors de la création du praticien.";
            }
        }
        
    } 
}


