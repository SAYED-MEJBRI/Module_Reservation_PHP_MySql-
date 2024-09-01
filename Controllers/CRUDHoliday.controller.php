<?php
// Inclusion de la classe Holiday
require_once '../models/Holiday.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération de l'action à effectuer (mise à jour, suppression ou ajout)
    $action = $_POST['action'];
    $holiday = new Holiday();

    if ($action === 'create') {
        // Récupérer les données soumises
        $date = $_POST['date'];
        $description = $_POST['description'];

        // Ajout du praticien dans la base de données
        $result = $holiday->createHoliday($date, $description);

        if ($result) {
            // Message de succès
            $message = 'le jours ferriers  a été ajouté avec succès.';
            header('Location: ../Views/displayHolidays.view.php');
            exit();
        } else {
            // Message d'erreur
            $message = 'Une erreur est survenue lors de l\'ajout du jour férries.';
        }
    } if ($action === 'update') {
        if (isset($_POST['submit'])) {
            // Récupération de l'id du jour férié depuis le POST
            $id = $_POST['holiday_id'];
    
            // Récupérer les données du formulaire
            $date = $_POST['date'];
            $description = $_POST['description'];
    
            // Mettre à jour le jour férié avec les nouvelles données
            $result = $holiday->updateHoliday($id, $date, $description);
    
            // Mise à jour des informations du jour férié dans la base de données
            if ($result) {
                // Message de succès
                $message = 'Le jour férié a été modifié avec succès.';
                header('Location: ../Views/displayHolidays.view.php');
                exit();
            } else {
                // Message d'erreur
                $message = 'Une erreur est survenue lors de la modification du jour férié.';
            }
        } else {
            // Récupération de l'id du jour férié depuis le GET
            $id = $_GET['id'];
    
            // Récupération des informations du jour férié à partir de l'id
            $holidayById = $holiday->getHolidayById($id);
    
            // Affichage du formulaire de modification avec les informations du jour férié
            include_once '../Views/updateHoliday.view.php';
        }
    }
    elseif ($action === 'delete') {
        // Récupération de l'id du jour férié à supprimer
        $id = $_POST['holiday_id'];

        // Suppression du jour férié de la base de données
        $result = $holiday->deleteHoliday($id);

        if ($result) {
            // Message de succès
            $message = 'Le jour férié a été supprimé avec succès.';
            header('Location: ../Views/displayHolidays.view.php');
            exit();
        } else {
            // Message d'erreur
            $message = 'Une erreur est survenue lors de la suppression du jour férié.';
        }
    }
    elseif ($action === 'delete-all') {
        // Suppression de tous les jours fériés de la base de données
        $holiday->deleteAllHolidays();
    
        // Message de succès
        $message = 'Tous les jours fériés ont été supprimés avec succès.';
        header('Location: ../Views/displayHolidays.view.php');
        exit();
    }
     elseif ($action === 'affiche') {

        // Récupération de l'id du praticien depuis le POST
        $id = $_POST['holiday_id'];

      

        // Récupération du praticien depuis la base de données

        $holidayById = $holiday->getHolidayById($id);


        if (!isset( $holidayById)) {
            // Message de succès
            $message = 'la salle  est trouvée.';
            header('Location: ../Views/updateHoliday.view.php');
            exit();
        } else {
            // Message d'erreur
            $message = 'Une erreur est survenue lors de la modification des jours férries.';
        }
    }
}



