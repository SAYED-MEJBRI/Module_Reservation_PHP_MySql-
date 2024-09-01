 <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } ?>
 <!-- En-tête de page contient un logo et une barre de navigation  qui va etre transformer en -->
 <header class=" mw-1320 m-auto d-flex jc-sb ai-c">
     <div class="header_logo">
         <a class="nav-link" href="../index.php">
             <img src="../assets/img/img_site/logo fond bleu.webp" alt="logo" width="100">
         </a>
     </div>
     <input id="menu-toggle" type="checkbox">
     <label class="menu-button-container " for="menu-toggle">
         <div class="menu-button  ">
             <img src="../assets/img/img_site/bars-solid.svg" height="30" alt="burger menu">
         </div>
     </label>
     <ul class="menu d-flex ">
         <li class="">
             <a class="nav-link" href="AllReservation.view.php">Réservation</a>
         </li>
         <li class="">
             <a class="nav-link" href="displayRooms.view.php">Rooms</a>
         </li>
         <li class="">
             <a class="nav-link" href="displayPractitioners.view.php">Practitioners</a>
         </li>

         <li class="">
             <a class="nav-link" href="displayCalendars.views.php">AjoutCalendrier</a>
         </li>
         <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) : ?>
             
                 <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION["first_name"] . ' ' . $_SESSION["last_name"]; ?>
                    </a> -->
                 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <!-- <form action="../Views/profilPratictioner.view.php" method="POST" id="profilForm">
                            <input type="hidden" name="prat_id" value="<?php echo $_SESSION['prat_id'] ?> ">
                            <button type="submit" class="dropdown-item" form="profilForm">Mon profil</button>
                        </form> -->
                     <form action="Views/reservationPratictioner.view.php" method="POST" id="reservationsForm">
                         <input type="hidden" name="action" value="reservations">
                         <input type="hidden" name="prat_id" value="<?php echo $_SESSION['prat_id'] ?> ">
                         <button type="submit" class="dropdown-item" form="reservationsForm">Mes réservations</button>
                     </form>
                 </div>
            
             <li class="nav-item">
                 <form action="../Controllers/CRUDPractitioner.controller.php" method="POST">
                     <input type="hidden" name="action" value="logoutAdmin">
                     <button type="submit" class="nav-link">Déconnexion</button>
                 </form>
             </li>
         <?php else : ?>
             <li class="nav-item">
                 <a class="" href="Views/loginUser.php">Connexion</a>
             </li>
             <li class="nav-item">
                 <a class="" href="loginUser.view.php">Inscription</a>
             </li>
         <?php endif; ?>
     </ul>

 </header>