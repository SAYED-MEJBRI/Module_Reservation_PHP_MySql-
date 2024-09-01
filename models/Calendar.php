<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'Database.php';
require_once 'Reservation.php';
require_once 'Room.php';
require_once 'Holiday.php';
class Calendar
{
    private $id;
    private $id_room;
    private $datetime_start;
    private $datetime_end;
    private $status;
    private $open_time;
    private $close_time;
    private $duration;

    public function __construct()
    {
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getIdRoom()
    {
        return $this->id_room;
    }

    public function getDatetimeStart()
    {
        return $this->datetime_start;
    }

    public function getDatetimeEnd()
    {
        return $this->datetime_end;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getOpenTime()
    {
        return $this->open_time;
    }

    public function getCloseTime()
    {
        return $this->close_time;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdRoom($id_room)
    {
        $this->id_room = $id_room;
    }

    public function setDatetimeStart($datetime_start)
    {
        $this->datetime_start = $datetime_start;
    }

    public function setDatetimeEnd($datetime_end)
    {
        $this->datetime_end = $datetime_end;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setOpenTime($open_time)
    {
        $this->open_time = $open_time;
    }

    public function setCloseTime($close_time)
    {
        $this->close_time = $close_time;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }


    function isDisabled()
    {

        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM calendar WHERE  is_disabled = 1');
        // $stmt->execute(array($start_datetime));
        $event = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($event !== false);
    }

    public function insertCalendar($id_room,   $open_time, $close_time, $duration){
        // Convertir les dates en format MySQL
        $open_time = date('H:i:s', strtotime($open_time));
        $close_time = date('H:i:s', strtotime($close_time));
        // Préparer la requête SQL pour insérer un calendrier
        $sql = "INSERT INTO calendar (id_room,  open_time, close_time, duration)
         VALUES (:id_room,   :open_time, :close_time, :duration)";
        $values = array(
            ':id_room' => $id_room,
            ':open_time' => $open_time,
            ':close_time' => $close_time,
            ':duration' => $duration
        );
        // Exécuter la requête SQL pour insérer un calendrier
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($values);
        // Vérifier si l'enregistrement a été effectué
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            echo "L'enregistrement du calendrier a été effectué avec succès.";
        } else {
            echo "Erreur : Impossible d'effectuer l'enregistrement du calendrier.";
        }
    }
    public function doesCalendarExist($room_id)
    {
        $sql = "SELECT COUNT(*) as count FROM calendar WHERE id_room = :room_id";
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':room_id', $room_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'];
        return ($count > 0); // Retourne true si un calendrier existe, sinon false
    }

    public function getCalendarById($calendarId)
    {
        // Préparer la requête SQL pour récupérer le calendrier par ID
        $sql = "SELECT * FROM calendar WHERE id_room = :calendarId";
        $values = array(
            ':calendarId' => $calendarId
        );

        // Exécuter la requête SQL pour récupérer le calendrier
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($values);

        // Vérifier s'il y a des résultats
        if ($stmt->rowCount() > 0) {
            // Récupérer les données du calendrier
            $calendarData = $stmt->fetch(PDO::FETCH_ASSOC);

            return $calendarData;
        } else {
            // Aucun calendrier trouvé avec l'ID spécifié
            return null;
        }
    }

    function afficheCalendar($id)
    {
        $mycalendar = new Calendar();
        if (isset($id)) {
            $calendrier = $mycalendar->getCalendarById($id);
            $room = new Room();
            $rom = $room->getRoomById($id);
            $reserver = new Reservation();
        } else {
            var_dump('erreur id');
        }

        if (isset($_GET['start_date'])) {
            $start_date = $_GET['start_date'];
        } else {
            $start_date = date('Y-m-d');
        }
?>

        <div class=" ">
            <h2>Calendrier du salon <?php echo $rom->getName() ?></h2>


            <div class=" ">

                <div class="">
                    <form action="Controllers/CRUDReservation.controller.php" method="post">

                        <div class=" d-flex  fw-wrap jc-se  g-1 my-3">
                            <?php
                            $start_time = $calendrier['open_time'];
                            $end_time = $calendrier['close_time'];
                            $slot = $calendrier['duration'];
                            $current_time = $start_time;

                            $hol = new Holiday();
                            $isHoliday = $hol->getAllHolidayDates();

                            while ($current_time < $end_time) {
                            ?>
                                <div class="calendar-box ">
                                    <div class="time"><?php echo $current_time; ?></div>
                                    <?php
                                    $current_date = $start_date;

                                    $current_datetime = $current_date . ' ' . $current_time;

                                    if (in_array($current_date, $isHoliday) ) {
                                        echo '<div class="status"><button class="btn btn-danger" disabled>Holiday</button></div>';
                                    }else if( date('N', strtotime($current_date)) >= 6){
                                        echo '<div class="status"><button class="btn btn-primary" disabled>Indisponible</button></div>';
                                    } else if (strtotime($current_datetime) < (time() + (4 * 60 * 60))) {
                                        echo '<div class="status"><button class="btn btn-secondary" disabled>Indisponible</button></div>';
                                    } else {
                                        $is_disabled = $reserver->isDisabled($current_datetime, $id);
                                        if ($is_disabled) {
                                            echo '<div class="status"><button class="btn btn-danger" disabled>Reserved</button></div>';
                                        } else {
                                            // echo '<div class="status"><input type="checkbox" name="selected_slots[]" value="' . $current_datetime . '"></div>';
                                            echo '<label class="status" style="display: block;">
                                            <p>disponible<p>
                                        <input class="selectHour" type="checkbox" name="selected_slots[]" value="' . $current_datetime . '">
                                        </label>';
                                        }
                                    }
                                    ?>
                                </div>
                            <?php
                                $current_time = date('H:i', strtotime($current_time . ' +' . $slot . ' minutes'));
                            }
                            ?>
                        </div>

                        <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) { ?>
                            <input type="hidden" name="id_room" id="id_room" class="form-control" value="<?php echo $id; ?>">
                            <div class="">
                                <input type="hidden" name="pract_id" id="pract_id" class="form-control" value="<?php echo $_SESSION['prat_id'] ?>">
                            </div>
                            <div class="">
                                <input type="hidden" name="action" value="creat">
                            </div>
                            <button type="submit" class="">Réserver les créneaux sélectionnés</button>
                        <?php }  ?>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
    function afficheCalendarAdmin($id)
    {
        $mycalendar = new Calendar();
        if (isset($id)) {
            $calendrier = $mycalendar->getCalendarById($id);
            $room = new Room();
            $rom = $room->getRoomById($id);
            $reserver = new Reservation();
        } else {
            var_dump('erreur id');
        }

        if (isset($_GET['start_date'])) {
            $start_date = $_GET['start_date'];
        } else {
            $start_date = date('Y-m-d');
        }
?>

        <div class=" ">
            <h2>Calendrier du salon <?php echo $rom->getName() ?></h2>


            <div class=" ">

                <div class="">
                    <form action="../Controllers/CRUDReservation.controller.php" method="post">

                        <div class=" d-flex  fw-wrap jc-se  g-1 my-3">
                            <?php
                            $start_time = $calendrier['open_time'];
                            $end_time = $calendrier['close_time'];
                            $slot = $calendrier['duration'];
                            $current_time = $start_time;

                            $hol = new Holiday();
                            $isHoliday = $hol->getAllHolidayDates();

                            while ($current_time < $end_time) {
                            ?>
                                <div class="calendar-box ">
                                    <div class="time"><?php echo $current_time; ?></div>
                                    <?php
                                    $current_date = $start_date;

                                    $current_datetime = $current_date . ' ' . $current_time;

                                    if (in_array($current_date, $isHoliday) ) {
                                        echo '<div class="status"><button class="btn btn-danger" disabled>Holiday</button></div>';
                                    }else if( date('N', strtotime($current_date)) >= 6){
                                        echo '<div class="status"><button class="btn btn-primary" disabled>Indisponible</button></div>';
                                    } else if (strtotime($current_datetime) < (time() + (4 * 60 * 60))) {
                                        echo '<div class="status"><button class="btn btn-secondary" disabled>Indisponible</button></div>';
                                    } else {
                                        $is_disabled = $reserver->isDisabled($current_datetime, $id);
                                        if ($is_disabled) {
                                            echo '<div class="status"><button class="btn btn-danger" disabled>Reserved</button></div>';
                                        } else {
                                            // echo '<div class="status"><input type="checkbox" name="selected_slots[]" value="' . $current_datetime . '"></div>';
                                            echo '<label class="status" style="display: block;">
                                            <p>disponible<p>
                                        <input class="selectHour" type="checkbox" name="selected_slots[]" value="' . $current_datetime . '">
                                        </label>';
                                        }
                                    }
                                    ?>
                                </div>
                            <?php
                                $current_time = date('H:i', strtotime($current_time . ' +' . $slot . ' minutes'));
                            }
                            ?>
                        </div>

                        <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) { ?>
                            <input type="hidden" name="id_room" id="id_room" class="form-control" value="<?php echo $id; ?>">
                            <div class="">
                                <input type="hidden" name="pract_id" id="pract_id" class="form-control" value="<?php echo $_SESSION['prat_id'] ?>">
                            </div>
                            <div class="">
                                <input type="hidden" name="action" value="creatAdmin">
                            </div>
                            <button type="submit" class="">Réserver les créneaux sélectionnés</button>
                        <?php }  ?>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
}

?>