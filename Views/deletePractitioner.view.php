<?php
// Inclusion de la classe Practitioner
require_once '../models/Practitioner.php';
require_once '../Controllers/CRUDPractitioner.controller.php';
?> 


<!DOCTYPE html>
<html lang="fr">
<?php include('../inc/head.inc.php'); ?>
<body>
<?php include('../inc/header1.inc.php'); ?>
<div class="container">
    <h1>Modifier le praticien</h1>
    <?php if ($message !== ''): ?>
        <div class="alert alert-primary" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="../Controllers/CRUDPractitioner.controller.php">
        <div class="form-group">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="practitioner_id" id="practitioner_id" class="form-control" value="<?php echo $practitionerById['practitioner_id']; ?>">
            <label for="first_name">Prénom :</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $practitionerById['first_name']; ?> " readonly>
        </div>
        <div class="form-group">
            <label for="last_name">Nom :</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $practitionerById['last_name']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo $practitionerById['email']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="phone">Téléphone :</label>
            <input type="tel" name="phone" id="phone" class="form-control" value="<?php echo $practitionerById['phone']; ?>" readonly>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Supprimer</button>
        </div>
    </form>
</div>

  <?php include('../inc/footer.inc.php'); ?>
</body>
</html>

  <?php include('../inc/footer.inc.php'); ?>
</body>
</html>
