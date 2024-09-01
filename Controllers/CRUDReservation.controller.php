<?php
// require_once 'config.php';
require_once '../models/Reservation.php';

if (isset($_POST["action"])) {
    $action = $_POST["action"];
    // Vérifier si l'utilisateur est connecté

    if ($action == "delete") {
        if (isset($_POST['reservation_id'])) {
            $id = $_POST['reservation_id'];

            $reservation = new Reservation();
            $reservation->deleteReservation($id);
            header('location: ../Views/reservationPratictioner.view.php');
            exit;
        }
    }
    if ($action == "deleteAdmin") {
        if (isset($_POST['reservation_id'])) {
            $id = $_POST['reservation_id'];

            $reservation = new Reservation();
            $reservation->deleteReservation($id);
            header('location: ../Views/AllReservation.view.php');
            exit;
        }
    }
    if ($action == "creat") {


        if (isset($_POST['selected_slots']) && is_array($_POST['selected_slots']) && count($_POST['selected_slots']) > 0) {
            // Récupérer les créneaux horaires sélectionnés
            $selected_slots = $_POST['selected_slots'];


            $user_id = $_POST['pract_id'];

            $room_id = $_POST['id_room'];


            $reservation = new Reservation($user_id, $room_id, $selected_slots);
            $reservation_id = $reservation->createReservation();

            if ($reservation_id) {
                // La réservation a été créée avec succès
                echo "La réservation a été enregistrée avec succès. ID de réservation : " . $reservation_id;
                header('location:../index.php');
            } else {
                // Une erreur s'est produite lors de la création de la réservation
                echo "Une erreur s'est produite lors de la création de la réservation.";
            }
        }
    }
    if ($action == "creatAdmin") {


        if (isset($_POST['selected_slots']) && is_array($_POST['selected_slots']) && count($_POST['selected_slots']) > 0) {
            // Récupérer les créneaux horaires sélectionnés
            $selected_slots = $_POST['selected_slots'];


            $user_id = $_POST['pract_id'];

            $room_id = $_POST['id_room'];


            $reservation = new Reservation($user_id, $room_id, $selected_slots);
            $reservation_id = $reservation->createReservationAdmin();

            if ($reservation_id) {
                // La réservation a été créée avec succès
                echo "La réservation a été enregistrée avec succès. ID de réservation : " . $reservation_id;
                header('location:../Views/indexAdmin.php');
            } else {
                // Une erreur s'est produite lors de la création de la réservation
                echo "Une erreur s'est produite lors de la création de la réservation.";
            }
        }
    } else {
        // Aucun créneau horaire sélectionné
        echo "Aucun créneau horaire sélectionné.";
    }
}
