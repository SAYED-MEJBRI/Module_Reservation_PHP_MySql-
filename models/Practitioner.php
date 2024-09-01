<?php
require_once 'Database.php';
class Practitioner
{
    // Attributs
    private $practitioner_id;
    private $first_name;
    private $last_name;
    private $email;
    private $phone;
    private $demande;
    private $mot_de_passe;
    private $kbis;
    private $attestation_assurance;

    // Constructeur
    public function __construct($practitioner_id = null, $first_name = null, $last_name = null, $email = null, $phone = null, $demande = null, $mot_de_passe = null, $kbis = null, $attestation_assurance = null)
    {
        $this->practitioner_id = $practitioner_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->demande = $demande;
        $this->mot_de_passe = $mot_de_passe;
        $this->kbis = $kbis;
        $this->attestation_assurance = $attestation_assurance;
    }

    // Accesseurs (getters)
    public function getPractitionerId()
    {
        return $this->practitioner_id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getDemande()
    {
        return $this->demande;
    }

    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    public function getKbis()
    {
        return $this->kbis;
    }

    public function getAttestationAssurance()
    {
        return $this->attestation_assurance;
    }

    // Mutateurs (setters)
    public function setPractitionerId($practitioner_id)
    {
        $this->practitioner_id = $practitioner_id;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setDemande($demande)
    {
        $this->demande = $demande;
    }

    public function setMotDePasse($mot_de_passe)
    {
        $this->mot_de_passe = $mot_de_passe;
    }

    public function setKbis($kbis)
    {
        $this->kbis = $kbis;
    }

    public function setAttestationAssurance($attestation_assurance)
    {
        $this->attestation_assurance = $attestation_assurance;
    }

    function getAllPractitioners()
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();
            $stmt = $conn->prepare('SELECT * FROM practitioner');
            $stmt->execute();

            $practitioners = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $practitioners;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getProfilById($id){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "SELECT * FROM practitioner WHERE practitioner_id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch();
        $practitioner = new Practitioner(
            $row['practitioner_id'],
            $row['first_name'],
            $row['last_name'],
            $row['email'],
            $row['phone'],
            $row['demande'],
            $row['mot_de_passe'],
            $row['kbis'],
            $row['attestation_assurance']
        );

        return $practitioner;
    }

    function addPractitioner($first_name, $last_name, $email, $phone, $password, $demande, $kbis, $attestation_assurance)
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            // Hacher le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


            $stmt = $conn->prepare("INSERT INTO practitioner (first_name, last_name, email, phone, 	mot_de_passe, demande, kbis, attestation_assurance) VALUES (:first_name, :last_name, :email, :phone, :hashedPassword, :demande, :kbis, :attestation_assurance)");

            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':hashedPassword', $hashedPassword);
            $stmt->bindParam(':demande', $demande);
            $stmt->bindParam(':kbis', $kbis['name']);
            $stmt->bindParam(':attestation_assurance', $attestation_assurance['name']);


            $stmt->execute();

            $message = "Le praticien a bien été ajouté";
            return $message;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteAllPractitioners(){
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            $stmt = $conn->prepare('DELETE FROM practitioner');
            $success = $stmt->execute();

            if ($success) {
                $directory = "../assets/img/documents_pratisionner/";

                // Parcourir tous les dossiers dans le répertoire
                $folders = glob($directory . "*", GLOB_ONLYDIR);
                foreach ($folders as $folder) {
                    // Supprimer le dossier
                    $success = self::deleteDirectory($folder);
                    if (!$success) {
                        echo "Erreur lors de la suppression du dossier : $folder <br>";
                    }
                }

                echo "Tous les praticiens et leurs dossiers ont été supprimés avec succès.";
            } else {
                echo "Erreur lors de la suppression des praticiens.";
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deletePractitionerById($practitionerId){
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();
            $pratitien = self::getProfilById($practitionerId);
            $stmt = $conn->prepare('DELETE FROM practitioner WHERE practitioner_id = :practitionerId');
            $stmt->bindParam(':practitionerId', $practitionerId);
            $success = $stmt->execute();

            if ($success) {
                $directory = "../assets/img/documents_pratisionner/";

                // Supprimer le dossier du praticien par ID
                $folder = $directory . $pratitien->getFirstName() . "_" . $pratitien->getLastName() . "/";
                $success = self::deleteDirectory($folder);
                header('location:../Views/displayPractitioners.view.php');
                exit();
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Fonction pour supprimer récursivement un dossier et son contenu
    function deleteDirectory($dirPath) {
        
        if (!is_dir($dirPath)) {
            return; // Le chemin n'est pas un dossier existant, donc rien à supprimer
        }

        $files = glob($dirPath . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file); // Supprimer les fichiers
            } 
        }

        rmdir($dirPath); // Supprimer le dossier lui-même
    }


    public function updatePractitioner($practitionerId, $first_name, $last_name, $email, $phone, $demande)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        // Mettre à jour le praticien dans la base de données
        $query = "UPDATE practitioner SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, demande = :demande WHERE practitioner_id = :practitioner_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':demande', $demande);
        $stmt->bindParam(':practitioner_id', $practitionerId);
        $stmt->execute();

        // Vérifier si des lignes ont été affectées
        return $stmt->rowCount() > 0;
    }


    public function searchPractitionerByEmail($email)
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();
            $stmt = $conn->prepare('SELECT * FROM practitioner WHERE email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si le praticien a été trouvé
            if ($result) {
                // Affecter les valeurs des propriétés de l'objet Practitioner
                $this->practitioner_id = $result['practitioner_id'];
                $this->first_name = $result['first_name'];
                $this->last_name = $result['last_name'];
                $this->email = $result['email'];
                $this->phone = $result['phone'];
                $this->demande = $result['demande'];
                $this->mot_de_passe = $result['mot_de_passe'];
                $this->kbis = $result['kbis'];
                $this->attestation_assurance = $result['attestation_assurance'];

                return true; // Le praticien a été trouvé
            } else {
                return false; // Le praticien n'a pas été trouvé
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false; // Une erreur s'est produite
        }
    }


    public function verifyPassword($password)
    {

        $hashedPassword = $this->getMotDePasse();
        return password_verify($password, $hashedPassword);
    }
}
