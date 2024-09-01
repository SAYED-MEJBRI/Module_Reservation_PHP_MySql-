<?php
require_once 'Database.php';
class Holiday
{
    // Attributs
    private $holiday_id;
    private $date;
    private $description;

    // Constructeur
    public function __construct($holiday_id = null, $date = null, $description = null)
    {
        $this->holiday_id = $holiday_id;
        $this->date = $date;
        $this->description = $description;
    }
    //  getters
    public function getHolidayId()
    {
        return $this->holiday_id;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getDescription()
    {
        return $this->description;
    }
    //  setters
    public function setHolidayId($holiday_id)
    {
        $this->holiday_id = $holiday_id;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    } 
    public function isDateHoliday($date) {
        // Obtenir l'instance de la base de données
        $db = Database::getInstance();
        $conn = $db->getConnection();
        // Préparer la requête SQL pour compter le nombre d'enregistrements correspondant à la date spécifiée dans la table "holiday"
        $query = "SELECT COUNT(*) as count FROM holiday WHERE date = :date";
        $stmt = $conn->prepare($query);    
        $stmt->bindParam(':date', $date);// Lier le paramètre :date avec la valeur $date pour éviter les problèmes de sécurité et d'injection SQL
        $stmt->execute();// Exécuter la requête SQL        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);// Récupérer le résultat de la requête
        $count = $row['count'];
        return ($count > 0) ? true : false;// Retourner true si le nombre d'enregistrements est supérieur à zéro, sinon retourner false
    }

    public function getAllHolidayDates() {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $query = "SELECT date FROM holiday";
        $stmt = $conn->query($query);

        $holidayDates = array();
        while ($row = $stmt->fetch()) {
            $holidayDates[] = $row['date'];
        }

        return $holidayDates;
    }
    public function createHoliday($date, $description){
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "INSERT INTO holiday (date, description) VALUES (:date, :description)";
        $stmt = $conn->prepare($query);

        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':description', $description);

        return $stmt->execute();
    }
    public function getHolidayById($id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM holiday WHERE holiday_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        return new Holiday($row['holiday_id'], $row['date'], $row['description']);
    }
    public function updateHoliday($id, $date, $description)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        // Préparation de la requête de mise à jour
        $query = "UPDATE holiday SET date = :date, description = :description WHERE holiday_id = :id";
        $stmt = $conn->prepare($query);

        // Association des valeurs aux paramètres
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':id', $id);

        // Exécution de la requête de mise à jour
        $result = $stmt->execute();

        return $result;
    }
    public function deleteHoliday($id)
    {

        $db = Database::getInstance();
        $conn = $db->getConnection();
        // Préparation de la requête SQL
        $sql = "DELETE FROM holiday WHERE holiday_id = :id";

        // Préparation de la requête avec PDO
        $stmt = $conn->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $result = $stmt->execute();

        // Retourner le résultat de la requête
        return $result;
    }
    public function deleteAllHolidays()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        // Préparation de la requête SQL
        $sql = 'DELETE FROM holiday';

        // Exécution de la requête SQL
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();

        // Retourner le résultat de l'exécution de la requête SQL
        return $result;
    }
}
