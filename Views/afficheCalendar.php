<?php


// Inclusion de la classe Room
include('../models/Holiday.php');
require_once '../models/Room.php';
require_once '../models/Calendar.php';

// Récupérer la liste des salles
$room = new Room();
$rooms = $room->getRooms();
$mycalendar= new Calendar();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('../inc/head.inc.php'); ?>
</head>
<body>

<?php

  include '../inc/header1.inc.php';
 

    
    $room= new Room();
    
    $reserver= new Reservation();

    if (isset($_GET['start_date'])) {
        $start_date = $_GET['start_date'];
    } else {
        $start_date = date('Y-m-d');
    }
  ?>
    <div class="container">
    <h1 class="">Réserver un salon </h1>
    <div class="">
            <div class=" ">
                <form action="afficheCalendar.php" method="get">
                    <input type="hidden" name="room_id" value="<?php echo $room->getRoomId(); ?>">

                    <div class="form-group my-2">
                        <label for="start_date">Date de début :</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo $start_date; ?>">
                        <!-- <?php echo '' ?> -->
                    </div>
                    <button type="submit" class="btn btn-primary">Afficher</button>
                </form>
            </div>
            <div class="col-md-8 text-right d-flex align-items-center my-2">
                <form action="afficheCalendar.php" method="get">
                    <input type="hidden" name="room_id" value="">
                    
                    <input type="hidden" name="start_date" value="<?php echo date('Y-m-d', strtotime($start_date . ' -1 day')); ?>">
                    <button type="submit" class="btn btn-primary">&lt;&lt; Précédent</button>
                </form>
                <form action="afficheCalendar.php" method="get">
                    <input type="hidden" name="room_id" value="<?php echo date('Y-m-d', strtotime($start_date . ' -1 day')); ?>   ">
                   
                    <input type="hidden" name="start_date" value="<?php echo date('Y-m-d', strtotime($start_date . ' +1 day')); ?>">
                    <button type="submit" class="btn btn-primary">Suivant &gt;&gt;</button>
                </form>
            </div>
        </div>

    <div class="row ">
        <?php foreach ($rooms as $room) { ?>
            <section>
        <div class=" ">
             <?php                   if ($mycalendar->doesCalendarExist($room->getRoomId())) {?> 
                <div class="room-card ">
              
                <h4 class="room-name">
                    <a href="displayCalendar.views.php?room_id=<?= $room->getRoomId(); ?>"><?= $room->getName(); ?></a>
                </h4>
                <div class="calendar-section ">
                    <?php
  
                        $mycalendar->afficheCalendar($room->getRoomId());
                    
                    // } else {
                    //     echo '<p class="no-calendar">Pas de calendrier!</p>';
                    // }
                    ?>
                </div>
                    <?php } ?>
            </div>
        </div>
                </section>
        <?php } ?>
    </div>
</div>

<a href="afficheCalendar2.php?">page reservation</a>
    <?php
  // Inclusion du fichier footer.php du dossier inc
  require_once(realpath(__DIR__ . '/../inc/footer.inc.php'));
?>
</body>
</html>
