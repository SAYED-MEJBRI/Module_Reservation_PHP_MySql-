<?php
// Inclusion de la classe Room
include('models/Holiday.php');
require_once 'models/Room.php';
require_once 'models/Calendar.php';

// Récupérer la liste des salles
$room = new Room();
$rooms = $room->getRooms();
$mycalendar = new Calendar();
?>
<!DOCTYPE html>
<html>

<head>
    <?php include('inc/head.inc.php'); ?>
</head>
<?php include 'inc/header.inc.php'; ?>

<body>
    <?php
    $room = new Room();
    $roms = $room->getRooms();

    foreach ($roms as $r) {
        // var_dump($room-> getRoomById($id));
        break;
    }
    // $id_r=$_GET['pays'];
    if (isset($_GET['pays'])) {
        $id_r = $_GET['pays'];
    } else {

        $id_r = $r->getRoomId();
    }

    if (isset($_GET['start_date'])) {
        $start_date = $_GET['start_date'];
    } else {
        $start_date = date('Y-m-d');
    }
    $s = $room->getRoomById($id_r);

    ?>
    <div class="mw-1320 m-auto">
        <section class="my-3 sec1">
            <h1 class="my-3">   Réserver maintenant </h1>

        </section>
    </div>
    <section class=" sec2 p-2 ">
        <div class="my-3">
            <form action="index.php" method="get">
                <div class="d-flex g-1 fw-wrap jc-se  ai-c mw-1320 m-auto">
                    <div class="">
                        <input type="hidden" name="room_id" value="<?php echo $room->getRoomId(); ?>">
                      

                        <label for="start_date">Date :</label>
                        <input type="date" name="start_date" id="start_date" class="" value="<?php echo $start_date; ?>">
                    </div>
                    <div class="">
                        <label for="pays">salle :</label>
                        <select id="pays" name="pays">
                          
                            <?php $iterator = 0;
                            while ($iterator < count($rooms)) {
                                $room = $rooms[$iterator];
                                $id = $room->getRoomId();
                                $nom = $room->getName();
                                echo "<option value=\"$id\">$nom</option>"; ?>
                            <?php $iterator++;
                            } ?>
                            >
                        </select>
                    </div>
                    <div class="">
                        <button type="submit" class="">Afficher</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    </div>
    <section class="partie3 p-2 ">
        <div class="mw-1320 m-auto">
            <div class="d-flex g-1 fw-wrap ac-c my-3">
                <div class="desc f-1-280  ">
                    
                        <h2>
                        <strong>    <?php echo $s->getName(); ?>  </strong>
                        </h2>
                        <!-- <p><?php echo $s->getDescription(); ?></p> -->
                  
                    <div class="my-1 ">
                        <?php
                        $link = "assets/img/img_room/" . $s->getImgFont(); ?>
                        <img src="<?php echo $link ?>" width="300" height="350" alt="hoto de salle">
                    </div>
                </div>
                <div class="f-2-560 my-1">
                    <?php  $mycalendar->afficheCalendar($id_r); ?>
                </div>
            </div>
    </section>
    <?php include('inc/footer.inc.php'); ?>
