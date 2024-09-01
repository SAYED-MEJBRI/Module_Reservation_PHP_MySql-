<?php
session_start();
$id = $_SESSION["prat_id"];
// Inclure le fichier contenant le ontrolleur professionnls
require_once('../Controllers/CRUDPractitioner.controller.php');
require_once('../models/Practitioner.php');
$Practitioner = new Practitioner();
$row = $Practitioner->getProfilById($id);
// var_dump($row);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include('../inc/headAdmin.inc.php'); ?>
</head>

<body>
    <?php include('../inc/header1.inc.php'); ?>

    <div class=" d-flex jc-c my-1">
        <h1 class="ast-heading">Mon profil</h1>


    </div>
    <section class="partie3 my-3">

        <form class="mw-900 m-auto my-3 p-3" action="../Controllers/CRUDPractitioner.controller.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="action" value="update">
            <div class="form-group">
                <label class="form-label" for="first_name">Prénom:</label>
                <input class="form-input" type="text" id="first_name" name="first_name" value="<?php echo $row->getFirstName() ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="last_name">Nom:</label>
                <input class="form-input" type="text" id="last_name" name="last_name" value="<?php echo $row->getLastName() ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email:</label>
                <input class="form-input" type="email" id="email" name="email" value="<?php echo $row->getEmail() ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="phone">Téléphone:</label>
                <input class="form-input" type="text" id="phone" name="phone" value="<?php echo $row->getPhone() ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="demande">Demande:</label>
                <textarea class="form-input" id="demande" name="demande"><?php echo $row->getDemande() ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Mot de passe:</label>
                <input class="form-input" type="text" id="password" name="password" value="<?php echo $row->getMotDePasse() ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="kbis">Kbis:</label>
                <input class="form-input" type="text" id="kbis" name="kbis" value="<?php echo $row->getKbis() ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="attestation_assurance">Attestation d'assurance:</label>
                <input class="form-input" type="text" id="attestation_assurance" name="attestation_assurance" value="<?php echo $row->getAttestationAssurance() ?>">
            </div>

            <div class="d-flex jc-se my-3">

                <button class="ast-button" type="submit">modifier</button>

                <a class="button" href="javascript:history.go(-1)">Retour</a>
            </div>
        </form>
    </section>
    </div>

    <?php include('../inc/footerAdmin.inc.php'); ?>
    <script src="../assets/js/jsLogin.asset.js"></script>

</body>

</html>