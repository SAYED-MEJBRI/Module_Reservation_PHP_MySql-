<?php
// Inclusion de la classe Practitioner
require_once '../models/Room.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération de l'action à effectuer (mise à jour, suppression ou ajout)
    $action = $_POST['action'];
    $room = new Room();

    if ($action === 'add') {

        // Vérifier si les champs requis sont présents

        // Récupérer les données soumises
        $name = $_POST['name'];
        $description = $_POST['description'];
        // $fotto = $_FILES['photo']['name'];
        $dest_path = "../assets/img/img_room/";

        // Vérifier si un fichier a été envoyé
        if (!empty($_FILES['photo']['name'])) {
            $filename = $_FILES['photo']['name'];
            $filename_no_ext = pathinfo($filename, PATHINFO_FILENAME);
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $filename_no_ext = strtolower($filename_no_ext);
            $newname = $filename_no_ext . "_" . time() . "." . $ext;

            // Vérifier si le fichier a été téléchargé avec succès
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $dest_path . $newname)) {
                $photo = $newname;
            } else {
                // Erreur lors du téléchargement du fichier
                echo "Une erreur est survenue lors du téléchargement du fichier.";
                // Arrêter le traitement ou afficher un message d'erreur approprié
                return;
            }
        } else {
            // Aucun fichier n'a été sélectionné
            echo "Veuillez sélectionner une photo.";
            // Arrêter le traitement ou afficher un message d'erreur approprié
            return;
        }

        // Ajout de la chambre dans la base de données
        $result = $room->createRoom($name, $description, $photo);

        // Vérifier si l'ajout a réussi ou afficher un message d'erreur
        if ($result) {
            echo 'la salle a été ajouté avec succès.';
            header('Location: ../Views/displayRooms.view.php');
            exit();
        } else {
            echo "Une erreur est survenue lors de l'ajout de la chambre.";
        }
    } elseif ($action === 'update') {
        
            // Récupération de l'id du praticien depuis le POST
            $id = $_POST['room_id'];
            // Récupérer les données du formulaire
            $name = $_POST['name'];
            $description = $_POST['description'];
            $ancimg= $_POST['image'];
            $img = $_POST["image"] ?? "";
            $photo = "";
            if (empty($_FILES['img']['name'])){
                $photo= $ancimg;
            }
            $dest_path="../assets/img/img_room/";
            if (!empty($_FILES['img']['name'])) {
                $filename = $_FILES['img']['name'];
                $filename_no_ext = pathinfo($filename, PATHINFO_FILENAME);
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $filename_no_ext = strtolower($filename_no_ext);
                $newname = $filename_no_ext . "_" . time() . "." . $ext;
    
                // Vérifier si le fichier a été téléchargé avec succès
                if (move_uploaded_file($_FILES['img']['tmp_name'], $dest_path . $newname)) {
                    $photo = $newname;
                    unlink($dest_path.$img);
                } else {
                    // Erreur lors du téléchargement du fichier
                    $photo= $img;
                }}
            // } else {
            //     // Aucun fichier n'a été sélectionné
            //     echo "Veuillez sélectionner une photo.";
            //     // Arrêter le traitement ou afficher un message d'erreur approprié
            //     return;
            // }

            $result = $room->updateRoom($id, $name, $description, $photo);



            // Mise à jour des informations du praticien dans la base de d

            if ($result) {
                // Message de succès
                $message = 'La salle a été modifié avec succès.';
                header('Location: ../Views/displayRooms.view.php');
                exit();
            } else {
                // Message d'erreur
                $message = 'Une erreur est survenue lors de la modification du salle.';
            
        }
    } elseif ($action === 'delete') {
        // Récupération de l'id du praticien à supprimer
        $id = $_POST['room_id'];

        $rom = $_POST['room'];
        $dir = "../assets/img/img_room/" . $rom;
        // Suppression du praticien de la base de données
        $result = $room->deleteRoom($id);

        unlink($dir);
        if ($result) {
            // Message de succès
            $message = 'Lea salle  a été supprimé avec succès.';
            header('Location: ../Views/displayRooms.view.php');
            exit();
        } else {
            // Message d'erreur
            $message = 'Une erreur est survenue lors de la suppression dude la salle.';
        }
    } elseif ($action === 'delete-all') {
        // Suppression de tous les praticiens de la base de données
        $room->deleteAllRoom();
        $dir = "../assets/img/img_room/"; // chemin du dossier contenant les images à supprimer

        // Supprime tous les fichiers du dossier
        foreach (glob($dir . '*.*') as $file) {
            if (is_file($file))
                unlink($file);
        }

        // Message de succès
        $message = 'Tous les salles ont été supprimés avec succès.';
        header('Location: ../Views/displayRooms.view.php');
        exit();
    } elseif ($action === 'affiche') {

        // Récupération de l'id du praticien depuis le POST
        $id = $_POST['room_id'];



        // Récupération du praticien depuis la base de données

        $roomById = $room->getRoomById($id);




        if (!isset($roomById)) {
            // Message de succès
            $message = 'la salle  est trouvée.';
            header('Location: ../Views/displayRooms.view.php');
            exit();
        } else {
            // Message d'erreur
            $message = 'Une erreur est survenue lors de la modification des salles.';
        }
    }
}
 ?>





