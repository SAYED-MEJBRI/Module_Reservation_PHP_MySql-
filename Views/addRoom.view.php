<?php
// Inclusion du fichier header.php du dossier inc
require_once(realpath(__DIR__ . '/../inc/headAdmin.inc.php'));
require_once(realpath(__DIR__ . '/../inc/headerAdmin.inc.php'));
?>

<div class="p-1">
  <div class=" mw-900 m-auto  d-flex jc-c my-3 ">
    <h1>Ajouter une salle</h1>
  </div>
  <div class="part">
    <form method="post" action="../Controllers/CRUDRoom.controller.php" enctype="multipart/form-data">
      <div class="mw-900 m-auto ">
        <input type="hidden" name="action" value="add">
        <div class="form-group">

          <label for="name">Nom :</label>
          <input type="text" name="name" id="name" class="form-input" required>
        </div>
        <div class="form-group">
          <label for="photo">Image :</label><br>
          <input type="file" id="photo" name="photo" class="form-input" required>
        </div>
        <div class="form-group">
          <label for="description">Description :</label>
          <textarea name="description" id="description" class="form-input" required></textarea>
        </div>

        <div class="d-flex jc-se my-3">
          <button type="submit" name="submit" class="">Enregistrer</button>
          <a href="rooms.view.php" class="button">Annuler</a>
        </div>
    </form>
  </div>
</div>

<?php
// Inclusion du fichier footer.php du dossier inc
require_once(realpath(__DIR__ . '/../inc/footerAdmin.inc.php'));
?>