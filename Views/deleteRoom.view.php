<?php
// Inclusion de la classe Practitioner

require_once '../Controllers/CRUDRoom.controller.php';;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Supprimer une salle</title>

</head>

<body>
    <div class="container">
        <h1 class="my-5">Supprimer la salle "<?php echo $roomById->getName(); ?>"</h1>

        <p class="mb-5">Êtes-vous sûr de vouloir supprimer cette salle ? Cette action est irréversible.</p>
        <form method="POST" action="../Controllers/CRUDRoom.controller.php?php echo $roomById->getRoomId(); ?>">
        <input type="hidden" name="action" value="delete">
    <input type="hidden" name="room_id" id="room_id" class="form-control" value="<?php echo $roomById->getRoomId() ?>">
    <input type="hidden" name="room" value="<?php echo $roomById->getImgFont();  ?>">
            <div class="form-group">
                <button type="submit" name="delete" class="btn btn-danger mr-3">Supprimer</button>
                <a href="displayRooms.view.php" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</body>

</html>