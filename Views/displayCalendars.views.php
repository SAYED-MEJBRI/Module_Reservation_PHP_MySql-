<?php
// Inclusion de la classe Room
require_once '../models/Room.php';
require_once '../models/Calendar.php';
$room = new Room();
$rooms = $room->getRooms();

?>


<!DOCTYPE html>
<html>

<?php include('../inc/headAdmin.inc.php'); ?>

<body>
    <?php include('../inc/headerAdmin.inc.php'); ?>
    <div class="d-flex jc-c my-3">
        <h1>Créer un nouveau calendrier</h1>
    </div>
    <div class="part my-3">
        <form class="mw-900 m-auto" method="post" action="../Controllers/CRUDCalendar.controller.php">
            <div class="form-group">
                <label for="room_id">Salle :</label>
                <select name="room_id" id="room_id" class="form-input">
                    <?php foreach ($rooms as $room) { ?>
                        <option value="<?= $room->getRoomId(); ?>"><?= $room->getName(); ?></option>
                    <?php } ?>
                </select>
            </div>


            <div class="form-group">
                <label for="open_time">Heure d'ouverture</label>
                <input type="time" class="form-input" id="open_time" name="open_time">
            </div>
            <div class="form-group">
                <label for="close_time">Heure de fermeture</label>
                <input type="time" class="form-input" id="close_time" name="close_time">
            </div>
            <div class="form-group">
                <label for="duration">Durée Slot (en minutes)</label>
                <input type="number" class="form-input" id="duration" name="duration">
            </div>

            <div class="d-flex jc-c my-3">
                <button type="submit">Remplir Calendrier</button>
            </div>
        </form>
    </div>
</body>

</html>