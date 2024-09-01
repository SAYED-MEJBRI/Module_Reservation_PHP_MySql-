<?php
// Inclusion de la classe Practitioner
require_once '../models/Practitioner.php';
require_once '../Controllers/CRUDPractitioner.controller.php';
// Récupération des praticiens depuis la base de données

// Récupérer les données du praticien depuis le paramètre de requête GET
$practitionerData = unserialize(urldecode($_GET['practitionerData']));

// Vérifier si les données du praticien existent




?>
<?php include('../inc/headAdmin.inc.php'); ?>

<body>
    <?php include('../inc/headerAdmin.inc.php'); ?>
    <div class="d-flex jc-c my-3">
        <h1>Modifier professionnel</h1>

    </div>
    <div class="part my-3">
        <form method="post" action="../Controllers/CRUDPractitioner.controller.php" enctype="multipart/form-data">
            <div class="container">
                <div class="form-group">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="practitioner_id" id="practitioner_id" class="form-input" value="<?php echo $practitionerData->getPractitionerId() ?>">
                    <label for="first_name">Prénom :</label>
                    <input type="text" name="first_name" id="first_name" class="form-input" value="<?php echo $practitionerData->getFirstName() ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Nom :</label>
                    <input type="text" name="last_name" id="last_name" class="form-input" value="<?php echo $practitionerData->getLastName() ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-input" value="<?php echo $practitionerData->getEmail() ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone :</label>
                    <input type="tel" name="phone" id="phone" class="form-input" value="<?php echo $practitionerData->getPhone() ?>">
                </div>
                <div class="form-group">
                    <label for="demande">Demande :</label>
                    <textarea name="demande" id="demande" class="form-input"><?php echo $practitionerData->getDemande() ?>"</textarea>
                </div>


                <div class="form-group">
                    <label for="kbis">Kbis :</label>
                    <input type="text" name="kbis" id="kbis" class="form-input" value="<?php echo $practitionerData->getKbis() ?>" readonly>

                    <input type="file" name="Nkbis" id="Nkbis" class="form-input">
                </div>
                <div class="form-group">
                    <label for="attestation_assurance">Attestation d'assurance :</label>
                    <input type="text" name="attestation_assurance" id="attestation_assurance" class="form-input" value="<?php echo $practitionerData->getAttestationAssurance() ?>" readonly>
                    <input type="file" name="Nattestation_assurance" id="Nattestation_assurance" class="form-input">
                </div>
                <div class="form-group">
                    <button type="submit" class="button ">Modifier</button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <?php include('../inc/footerAdmin.inc.php'); ?>
</body>

</html>