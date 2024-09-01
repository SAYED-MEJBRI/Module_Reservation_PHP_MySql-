<?php
// Inclusion de la classe Calendar
require_once '../models/Calendar.php';
require_once '../models/Room.php';
// Récupération de la liste des salles
$calendar = new Calendar();
// $rooms = $calendar->getDistinctRooms();
// $rooms = new Room();
// $rooms->getRooms();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des calendriers</title>
</head>
<body>
    <h1>Liste des calendriers</h1>
    <table>
        <thead>
            <tr>
                <th>Salle</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rooms as $room) { ?>
                <tr>
                <td></td>
                    <?php foreach ($calendar->getCalendarEvents($room) as $event) { ?>
                        <tr>
                            <td></td>
                            <td><?= $event['date'] ?></td>
                            <td><?= $event['time'] ?></td>
                            <td><?= $event['status'] ?></td>
                        </tr>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
