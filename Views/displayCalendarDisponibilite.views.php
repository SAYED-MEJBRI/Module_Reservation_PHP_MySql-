<?php
include('../models/Calendar.php');
include('../models/Holiday.php');
include('../models/Room.php');
$id = $_GET['room_id'];
$mycalendar = new Calendar();
?>
<!DOCTYPE html>
<html lang="fr">

<?php include('../inc/head.inc.php'); ?>

<body>
    <?php 
    include('../inc/header1.inc.php');
    ?>
    <?php
    $mycalendar->afficheCalendar($id); 
    ?>
     <?php 
    include('../inc/footer.inc.php');
    ?>
</body>

</html>