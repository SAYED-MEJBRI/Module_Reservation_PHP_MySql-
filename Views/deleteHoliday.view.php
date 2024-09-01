<?php include('../Controllers/CRUDHoliday.controller.php'); ?>
<!DOCTYPE html>
<html>
<?php include('../inc/head.inc.php'); ?>

<body>
<?php include('../inc/header1.inc.php'); ?>
    
    <h1>Modification d'un jour férié</h1>
    
    <form method="post" action="../Controllers/CRUDHoliday.controller.php">
    <input type="hidden" name="action" value="delete-all">
    <input type="hidden" name="holiday_id" value="<?php echo $holidayById->getHolidayId(); ?>" readonly>
    
        <div class="form-group">
            <label for="date">Date :</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo $holidayById->getDate(); ?>" readonly >
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo$holidayById->getDescription(); ?>" readonly>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Supprimer</button>
    </form>

<?php include('../inc/footer.inc.php'); ?>
</body>
</html>

