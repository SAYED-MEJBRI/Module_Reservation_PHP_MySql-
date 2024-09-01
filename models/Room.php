<?php
 require_once 'Database.php';
class Room
{
    // Attributs
    private $room_id;
    private $name;
    private $description;
    private $Img_Font;
    // Constructeur
    public function __construct($room_id = null, $name = null, $description = null, $Img_Font = null)
    {
        $this->room_id = $room_id;
        $this->name = $name;
        $this->description = $description;
        $this->Img_Font = $Img_Font;
    }
    // getters
    public function getRoomId()
    {
        return $this->room_id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function getImgFont()
    {
        return $this->Img_Font;
    }

    // setters
    public function setRoomId($room_id)
    {
        $this->room_id = $room_id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setImgFont($Img_Font)
    {
        $this->Img_Font = $Img_Font;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
    // Fonction de présentation des salles
    public function getRooms()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $query = "SELECT * FROM room";
        $stmt = $conn->query($query);

        $rooms = array();
        while ($row = $stmt->fetch()) {
            $room = new Room($row['room_id'], $row['room_name'], $row['room_description'], $row['Img_Font']);
            $rooms[] = $room;
        }

        return $rooms;
    }
    public function getRoomById($id)
    {
        // Obtenir l'instance de la base de données
        $db = Database::getInstance();
        $conn = $db->getConnection();
        // Préparer la requête SQL pour sélectionner les informations de la salle correspondant à l'identifiant spécifié
        $query = "SELECT * FROM room WHERE room_id = :id";
        $stmt = $conn->prepare($query);
        // Lier le paramètre :id avec la valeur $id pour éviter les problèmes de sécurité et d'injection SQL
        $stmt->bindParam(':id', $id);
        $stmt->execute(); // Exécuter la requête SQL
        $row = $stmt->fetch(); // Récupérer la première ligne de résultat de la requête
        // Créer une nouvelle instance de la classe Room en utilisant les valeurs récupérées de la base de données
        $room = new Room($row['room_id'], $row['room_name'], $row['room_description'], $row['Img_Font']);
        return $room; // Retourner l'objet Room créé
    }


    public function createRoom($name, $description, $photo)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "INSERT INTO room (room_name, room_description, Img_Font) VALUES (:name, :description, :photo)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':photo', $photo);
        $stmt->execute();

        return $stmt->rowCount() > 0; // Vérifier si l'insertion a été effectuée
    }

    public function updateRoom($id, $name, $description, $photo)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "UPDATE room SET room_name = :name, room_description = :description, Img_Font = :photo WHERE room_id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':photo', $photo);
        $stmt->execute();

        return $stmt->rowCount() > 0; // Vérifier si la modification a été effectuée
    }

    public function deleteRoom($id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "DELETE FROM room WHERE room_id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);

        $result = $stmt->execute();
        return $result;
    }
    function deleteAllRoom()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $query = "DELETE FROM room";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    }
}
