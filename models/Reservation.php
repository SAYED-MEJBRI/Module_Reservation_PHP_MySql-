<?php 
require_once 'Database.php';
class Reservation {
  private $reservation_id;
  private $practitioner_id;
  private $room_id;
  private $slots;
  
  public function __construct($practitioner_id =null, $room_id=null, $slots=null) {
      $this->reservation_id = uniqid();
      $this->practitioner_id = $practitioner_id;
      $this->room_id = $room_id;
      $this->slots = $slots;
  }
  
  public function getReservationId() {
      return $this->reservation_id;
  }
  
  public function getPractitionerId() {
      return $this->practitioner_id;
  }
  
  public function getRoomId() {
      return $this->room_id;
  }
  
  public function getSlots() {
      return $this->slots;
  }
  
  public function setReservationId($reservation_id) {
      $this->reservation_id = $reservation_id;
  }
  
  public function setPractitionerId($practitioner_id) {
      $this->practitioner_id = $practitioner_id;
  }
  
  public function setRoomId($room_id) {
      $this->room_id = $room_id;
  }
  
  public function setSlots($slots) {
      $this->slots = $slots;
  }
  
  public function createReservation() {
    // Récupérer une instance de la connexion à la base de données
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Vérifier la disponibilité des créneaux horaires sélectionnés
    foreach ($this->slots as $slot) {
    
      // Vérifier si le créneau est désactivé (réservé) dans la base de données
    $current_datetime_json = json_encode($slot);

      // Effectuer une requête pour vérifier si le créneau est déjà réservé
      $query = "SELECT COUNT(*) FROM reservation WHERE slots = :slot";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':slot', $current_datetime_json);
      $stmt->execute();

      // Vérifier le résultat de la requête
      if ($stmt->fetchColumn() > 0) {
          // Le créneau est déjà réservé, afficher un message d'erreur approprié ou lever une exception
          // ...
      }
  }
    // Insérer la réservation dans la base de données
   
    $query = "INSERT INTO reservation (practitioner_id, room_id, slots, date) VALUES (:practitioner_id, :room_id, :slots, NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':practitioner_id', $this->practitioner_id);
    $stmt->bindParam(':room_id', $this->room_id);

    $jsonSlots = json_encode($this->slots);
    $stmt->bindParam(':slots', $jsonSlots);

    $stmt->execute();

    // Gérer les erreurs éventuelles lors de l'insertion
    if ($stmt->rowCount() == 0) {
        // La réservation n'a pas pu être insérée, afficher un message d'erreur approprié ou lever une exception
        echo "La réservation n'a pas pu être effectuée.";
    } else {
        // Afficher un message de confirmation de la réservation
        echo "La réservation a été effectuée avec succès !";
        header('location:../index.php');
        exit();
    }

    // Fermer la connexion à la base de données
    $conn = null;
}

public function createReservationAdmin() {
    // Récupérer une instance de la connexion à la base de données
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Vérifier la disponibilité des créneaux horaires sélectionnés
    foreach ($this->slots as $slot) {
    
      // Vérifier si le créneau est désactivé (réservé) dans la base de données
    $current_datetime_json = json_encode($slot);

      // Effectuer une requête pour vérifier si le créneau est déjà réservé
      $query = "SELECT COUNT(*) FROM reservation WHERE slots = :slot";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':slot', $current_datetime_json);
      $stmt->execute();

      // Vérifier le résultat de la requête
      if ($stmt->fetchColumn() > 0) {
          // Le créneau est déjà réservé, afficher un message d'erreur approprié ou lever une exception
          // ...
      }
  }
    // Insérer la réservation dans la base de données
   
    $query = "INSERT INTO reservation (practitioner_id, room_id, slots, date) VALUES (:practitioner_id, :room_id, :slots, NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':practitioner_id', $this->practitioner_id);
    $stmt->bindParam(':room_id', $this->room_id);

    $jsonSlots = json_encode($this->slots);
    $stmt->bindParam(':slots', $jsonSlots);

    $stmt->execute();

    // Gérer les erreurs éventuelles lors de l'insertion
    if ($stmt->rowCount() == 0) {
        // La réservation n'a pas pu être insérée, afficher un message d'erreur approprié ou lever une exception
        echo "La réservation n'a pas pu être effectuée.";
    } else {
        // Afficher un message de confirmation de la réservation
        echo "La réservation a été effectuée avec succès !";
        header('location:../Views/indexAdmin.php');
        exit();
    }

    // Fermer la connexion à la base de données
    $conn = null;
}

public function isDisabled($current_datetime, $id) {
  // Récupérer une instance de la connexion à la base de données
  $db = Database::getInstance();
  $conn = $db->getConnection();

  // Vérifier si le créneau est désactivé (réservé) dans la base de données
  $query = "SELECT COUNT(*) FROM reservation WHERE room_id = :id_room AND JSON_CONTAINS(slots, :current_datetime, '$')";

  $stmt = $conn->prepare($query);
  // Convertir la date en une chaîne JSON
  $current_datetime_json = json_encode($current_datetime);
  $stmt->bindParam(':current_datetime',  $current_datetime_json);
  $stmt->bindValue(':id_room', $id, PDO::PARAM_INT);

  $stmt->execute();

  // Vérifier le résultat de la requête
  $isDisabled = ($stmt->fetchColumn() > 0);

  return $isDisabled ? true : false;
}
   
public function getReservationsByPractitionerID($practitionerID) {
    $reservations = array();

    // Exemple de requête pour récupérer les réservations du praticien dans une base de données
    $query = "SELECT reservation.*, room.room_name FROM reservation
    INNER JOIN room ON reservation.room_id = room.room_id
    WHERE reservation.practitioner_id = :id";
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $practitionerID);
        $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Des réservations ont été trouvées, récupérer les données
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $reservations;
}


function deleteReservation($id) {
    // Add your code to delete the reservation with the provided ID using the provided connection
    $db = Database::getInstance();
    $conn = $db->getConnection();
    // Example code to delete a reservation from a database table
    $sql = "DELETE FROM reservation WHERE reservation_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Optionally, you can check if the deletion was successful
    if ($stmt->rowCount() > 0) {
        echo "Reservation deleted successfully.";
    } else {
        echo "Failed to delete reservation.";
    }
}
public function getAllReservations() {
    $reservations = array();

    // Exemple de requête pour récupérer toutes les réservations dans une base de données
    $query = "SELECT reservation.*, room.room_name FROM reservation
    INNER JOIN room ON reservation.room_id = room.room_id";
    
    $db = Database::getInstance();
    $conn = $db->getConnection();
    $stmt = $conn->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Des réservations ont été trouvées, récupérer les données
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $reservations;
}











}


?>