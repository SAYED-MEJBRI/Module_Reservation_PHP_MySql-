<?php
// Inclusion de la classe Practitioner
require_once '../models/Practitioner.php';

// Récupération des praticiens depuis la base de données
$practitioner = new Practitioner();
$allPractitioners = $practitioner->getAllPractitioners();
?>

<!DOCTYPE html>
<html>
<?php include('../inc/headAdmin.inc.php'); ?>

<body>
  <?php include('../inc/headerAdmin.inc.php'); ?>

<div class="d-flex jc-c my-3">
  <h1>liste des professionnels</h1>
</div>
  <div class="container">
    <div class="d-flex jc-sb fw-wrap">
      <div class="">

        <a href="addPractitioner.view.php" class="button">Ajouter praticien</a>
      </div>
      <div>
        <form method="post" action="../Controllers/CRUDPractitioner.controller.php" class="mb-3">
          <input type="hidden" name="action" value="deleteAll">
          <button type="submit" class="">Supprimer tous les praticiens</button>
        </form>
      </div>


    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Prénom</th>
              <th>Nom</th>
              <th>Email</th>
              <th>Téléphone</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($allPractitioners as $practitioner) : ?>
              <tr>
                <td><?php echo $practitioner['practitioner_id']; ?></td>
                <td><?php echo $practitioner['first_name']; ?></td>
                <td><?php echo $practitioner['last_name']; ?></td>
                <td><?php echo $practitioner['email']; ?></td>
                <td><?php echo $practitioner['phone']; ?></td>
                <td>
                  <div class="d-flex justify-content-center">
                    <form method="post" action="updatePractitioner.view.php">
                      <input type="hidden" name="practitioner_id" value="<?php echo $practitioner['practitioner_id']; ?>">
                      <input type="hidden" name="action" value="affiche">
                      <button type="submit" class="2">Modifier</button>
                    </form>
                    <form method="post" action="../Controllers/CRUDPractitioner.controller.php">
                      <input type="hidden" name="action" value="deleteById">
                      <input type="hidden" name="practitioner_id" value="<?php echo $practitioner['practitioner_id']; ?>">
                      <button type="submit" class="">Supprimer</button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>






  <?php include('../inc/footerAdmin.inc.php'); ?>
</body>

</html>