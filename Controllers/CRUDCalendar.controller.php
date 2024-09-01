<?php
// Inclusion de la classe Calendar
require_once '../models/Calendar.php';
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = $_POST['room_id']; // Récupérer les données du formulaire
    $open_time = $_POST['open_time'];
    $close_time = $_POST['close_time'];
    $duration = $_POST['duration'];
    if (empty($room_id)) {
        die("L'identifiant de la salle est requis.");// Vérifier si l'identifiant de la salle est vide
    }
    // Vérifier si l'identifiant de la salle est un entier positif
    if (!is_numeric($room_id) || $room_id <= 0) {
        die("L'identifiant de la salle doit être un entier positif.");
    }
    if (!is_numeric($duration) || $duration <= 0) {
        die("La durée doit être un nombre positif."); // Vérifier si la durée est un nombre positif
    }
    try {
        $calendar = new Calendar();// Créer une instance de la classe Calendar

        $calendar->insertCalendar($room_id, $open_time, $close_time, $duration);
        header('Location: ../Views/indexAdmin.php');// Rediriger vers la page de visualisation des calendriers
        exit;
    } catch (Exception $e) {
        // Afficher le message d'erreur personnalisé
        die("Une erreur est survenue lors de la création du calendrier : " . $e->getMessage());
    }
}



