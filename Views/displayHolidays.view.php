<?php
// Inclusion de la classe Practitioner
require_once '../models/Holiday.php';
$allHolidays = [];
// Récupération des praticiens depuis la base de données
$holid = new Holiday();
$allHolidays = $holid->getAllholidays();

?>

<!DOCTYPE html>
<html>
<?php include('../inc/head.inc.php'); ?>

<body>
    <?php include('../inc/header1.inc.php'); ?>


    <h1>Liste des jours fériés</h1>

    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <a href="addHoliday.view.php" class="btn btn-success btn-block">Ajouter un jour férié</a>
            </div>
            <form method="post" action="../Controllers/CRUDHoliday.controller.php" class="mb-3">
                <input type="hidden" name="action" value="delete-all">
                <button type="submit" class="btn btn-danger">Supprimer tous les jours fériés</button>
            </form>
        </div>

        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allHolidays as $holiday) : ?>

                                <tr>
                                    <td><?php echo $holiday->getHolidayId(); ?></td>
                                    <td><?php echo $holiday->getDescription(); ?></td>
                                    <td><?php echo $holiday->getdate(); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form method="post" action="updateHoliday.view.php">
                                                <input type="hidden" name="holiday_id" value="<?php echo $holiday->getHolidayId(); ?>">
                                                <input type="hidden" name="action" value="affiche">
                                                <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                                            </form>
                                            <form method="post" action="deleteHoliday.view.php">
                                                <input type="hidden" name="action" value="affiche">
                                                <input type="hidden" name="holiday_id" value="<?php echo $holiday->getHolidayId(); ?>">
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
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

    <?php include('../inc/footer.inc.php'); ?>
</body>

</html>