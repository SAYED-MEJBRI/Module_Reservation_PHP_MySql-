<?php



// Inclure le fichier contenant la classe Room
require_once('../Controllers/CRUDRoom.controller.php');



?>

<!DOCTYPE html>
<html lang="fr">
<?php include('../inc/headAdmin.inc.php'); ?>

<body>
  <?php include('../inc/headerAdmin.inc.php'); ?>
  <div class="mw-900 m-auto">
    <div class=" d-flex jc-c my-3">
  <h1>Modifier la salle <?php echo $roomById->getName(); ?></h1>
</div>
  <form action="../Controllers/CRUDRoom.controller.php?php echo $roomById->getRoomId(); ?>" method="post" enctype="multipart/form-data">
  
    <div class="form-group">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="room_id" id="room_id" class="form-control" value="<?php echo $roomById->getRoomId() ?>">
      <div class="col-md-4">
  <div class="form-group card mb-4 box-shadow">
      <?php $chemin_image_complet = "../assets/img/img_room/" . $roomById->getImgFont();
      ?>

      <img class="card-img-top" src="<?php echo $chemin_image_complet; ?>"   alt="<?php echo $room->getName(); ?>	 ">
      <input type="hidden" id="image" name="image" value="<?php echo $roomById->getImgFont(); ?>">
    </div>
    </div>
    <div class="form-group">
    <label for="img">Image :</label><br>
    <input type="file" id="img" name="img" >
    </div>
      <label for="name">Nom :</label>
      <input type="text" name="name" id="name" value="<?php echo $roomById->getName(); ?>" class="form-control">
    </div>
    
    <div class="form-group">
      <label for="description">Description :</label>
      <textarea name="description" id="description" class="form-control"><?php echo $roomById->getDescription(); ?></textarea>
    </div>

    <div class="d-flex jc-sb my-3">
      <button type="submit" name="submit" class="">Modifier</button>
      <a href="rooms.view.php" class="button">Annuler</a>
    </div>
  </form>
  </div>
  <?php include('../inc/footerAdmin.inc.php'); ?>
</body>

</html>