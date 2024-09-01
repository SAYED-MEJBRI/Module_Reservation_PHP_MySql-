<?php
// Inclusion de la classe Room
require_once '../models/Room.php';

$room= new Room();
$rooms=$room->getRooms();
?> 

<!DOCTYPE html>
<html>
<?php include('../inc/headAdmin.inc.php'); ?>

<body>
<?php include('../inc/headerAdmin.inc.php'); ?>
    
<div class="d-flex jc-c my-3">
	<div>
	

    <h1>Liste des salles</h1>
</div>
</div>
<div class=" p-1 partie3">
	<div class="mw-1320 m-auto d-flex jc-se fw-wrap">
		<div class="p-1">
			<a href="addRoom.view.php" class="button">Ajouter salle</a>
		</div>
		<form method="post" action="../Controllers/CRUDRoom.controller.php" class="mb-3">
			<input type="hidden" name="action" value="delete-all">
			<button type="submit" class="">Supprimer toutes les salles</button>
		</form>
	</div>
</div>

<div class=" p-1 partie3">
	<div class="mw-1320 m-auto d-flex jc-se fw-wrap">
		<?php foreach ($rooms as $room): ?>
			<div class="col-md-4">
				<div class="card mb-4 box-shadow">
				<?php $chemin_image_complet = "../assets/img/img_room/" . $room->getImgFont();
				?>
        
	  <img class="card-img-top" src="<?php echo $chemin_image_complet; ?>" alt="<?php echo $room->getName(); ?>	 ">
					<div class="card-body">
						<h2 class="card-title"><?php echo $room->getName(); ?></h2>
						<p class="card-text"><?php echo $room->getDescription(); ?></p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="btn-group">
								 <form method="post" action="updateRoom.view.php">
                    <input type="hidden" name="room_id" value="<?php echo $room->getRoomId(); ?>" >
                    <input type="hidden" name="action" value="affiche">
                    <button type="submit" class="">Modifier</button>
                  </form>
				  <form method="post" action="deleteRoom.view.php">
                  <input type="hidden" name="action" value="affiche">
                    <input type="hidden" name="room_id" value="<?php echo $room->getRoomId(); ?>">
				
					<input type="hidden" name="room" value="<?php echo $room->getImgFont();  ?>">
                    <button type="submit" class="">Supprimer</button>
                  </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>



                <?php include('../inc/footerAdmin.inc.php'); ?>
</body>
</html>