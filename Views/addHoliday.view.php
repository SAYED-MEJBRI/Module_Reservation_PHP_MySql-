<!DOCTYPE html>
<html>
<?php include('../inc/head.inc.php'); ?>

<body>
<?php include('../inc/header1.inc.php'); ?>

<h1>Ajouter un jour férié</h1>

<div class="container">
    <form method="post" action="../Controllers/CRUDHoliday.controller.php">
        <input type="hidden" name="action" value="create">
        <div class="form-group">
            <label for="date">Date :</label>
            <input type="date" class="form-control" name="date" id="date" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <input type="text" class="form-control" name="description" id="description" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include('../inc/footer.inc.php'); ?>
</body>
</html>
