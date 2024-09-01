<?php


// Inclusion de la classe Room
include('../models/Holiday.php');
require_once '../models/Room.php';
require_once '../models/Calendar.php';

// Récupérer la liste des salles
$room = new Room();
$rooms = $room->getRooms();
$mycalendar = new Calendar();
?>
<!DOCTYPE html>
<html>

<head>
    <?php include('../inc/head.inc.php'); ?>
</head>
<header><?php include '../inc/header.inc.php'; ?></header>

<body>

    <?php
    $room = new Room();
    $reserver = new Reservation();
    if (isset($_GET['start_date'])) {
        $start_date = $_GET['start_date'];
    } else {
        $start_date = date('Y-m-d');
    }
    ?>
    <div>
        <h1 class="my-3">Réserver un salon </h1>
        <div class="d-flex g-1 jc-sb my-3">
            <div class="formulaire ">
                <form class="d-flex g-1" action="afficheCalendar2.php" method="get">

                    <div class="f-1-280"><input type="hidden" name="room_id" value="<?php echo $room->getRoomId(); ?>">
                        <label for="start_date">Date de début :</label>
                        <input type="date" name="start_date" id="start_date" class="" value="<?php echo $start_date; ?>">
                    </div>
                    <divclass="f-1-280">
                        <button type="submit" class="btn btn-primary">Afficher</button>
                </form>
            </div>
            <div class="d-flex g-1 jc-sb">
                <form action="afficheCalendar2.php" method="get">
                    <input type="hidden" name="room_id" value="">

                    <input type="hidden" name="start_date" value="<?php echo date('Y-m-d', strtotime($start_date . ' -1 day')); ?>">
                    <button type="submit" class="btn btn-primary">&lt;&lt; Précédent</button>
                </form>
                <form action="afficheCalendar2.php" method="get">
                    <input type="hidden" name="room_id" value="<?php echo date('Y-m-d', strtotime($start_date . ' -1 day')); ?>   ">

                    <input type="hidden" name="start_date" value="<?php echo date('Y-m-d', strtotime($start_date . ' +1 day')); ?>">
                    <button type="submit" class="btn btn-primary">Suivant &gt;&gt;</button>
                </form>
            </div>
        </div>
        <?php foreach ($rooms as $room) { ?>
            <section class="p-2 my-2">
                <div class="mw-1320 m-auto">



                    <div class="bottom">
                        <?php if ($mycalendar->doesCalendarExist($room->getRoomId())) { ?>
                            <div class="d-flex g-1 fw-wrap ac-c my-3">
                                <div class="f-1-280 d-flex jc-c ">
                                    <h4 class="room-name ">

                                    </h4>
                                    <div class="my-3 ">
                                        <?php $link = "../assets/img/img_room/" . $room->getImgFont(); ?>
                                        <img src="<?php echo $link ?>" width="400" height="350" alt="hoto de salle">
                                    </div>
                                </div>
                                <div class="f-2-560 my-3">
                                    <?php

                                    $mycalendar->afficheCalendar($room->getRoomId());


                                    ?>
                                </div>

                            </div>
                    </div><?php } ?>
                </div>

            </section>
        <?php } ?>

    </div>
</body>

</html>