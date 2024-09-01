<?php // Inclure le fichier contenant le ont
// session_start();
require_once('../models/Reservation.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('../inc/headAdmin.inc.php'); ?>
</head>

<body>
    <?php include('../inc/header1.inc.php'); ?>

    <?php
    // Inclure le fichier contenant le contrôleur des praticiens
    require_once('../Controllers/CRUDPractitioner.controller.php');
    ?>
    <div class=" my-3 d-flex jc-c">
        <h1 class="my-3">suivre vos reservations</h1>
    </div>
    <div class="partie3 my-3">
        <div class="mw-1320 m-auto my-3">
            <?php
            $practitionerID = $_SESSION['prat_id'];

            // Obtenez toutes les réservations du praticien
            $myreservation = new Reservation();
            $reservations =  $myreservation->getReservationsByPractitionerID($practitionerID);
            if (!empty($reservations)) {
                echo '<div class="mw-900 m-auto my-3">';
                echo "<table  class='table table-striped table-bordered my-3'>";
                echo "<tr><th>Salle</th><th>Date de réservation</th><th>Sréneaux réservés</th><th>Actions</th></tr>";

                foreach ($reservations as $reservation) {
                    echo "<tr>";
                     "<td>" . $reservation['reservation_id'] . "</td>";
                    echo "<td>" . $reservation['room_name'] . "</td>";
                    echo "<td>" . $reservation['date'] . "</td>";
                    echo "<td>" . $reservation['slots'] . "</td>";

                    echo "<td>";
            ?>
                    <form action='../Controllers/CRUDReservation.controller.php' method='POST'>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
                        <button type='submit' class=''>Supprimer réservation</button>
                    </form>
            <?php
                    echo "</td>";

                    echo "</tr>";
                }

                echo "</table>";
                echo '</td>';
            } else {
                echo "Vous n'avez pas de réservation.";
            }


            ?>
        </div>
    </div>

    <?php include('../inc/footerAdmin.inc.php'); ?>
    <script src="../assets/js/jsLogin.asset.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</body>

</html>