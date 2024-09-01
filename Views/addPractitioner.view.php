<?php include('../inc/headAdmin.inc.php'); ?>

<body>
    <?php include('../inc/headerAdmin.inc.php'); ?>

    <div class="d-flex jc-c my-3 mw-900 m-auto">
        <h1>Ajouter un nouveau praticien</h1>
    </div>
    <div class="part my-3">
        <form method="post" action="../Controllers/CRUDPractitioner.controller.php" enctype="multipart/form-data">
            <div class="mw-900 m-auto ">
                <div class="">
                    <input type="hidden" name="action" value="createAdmin">
                    <label for="first_name">Prénom :</label>
                    <input type="text" name="first_name" id="first_name" class="form-input" required>
                </div>
                <div class="">
                    <label for="last_name">Nom :</label>
                    <input type="text" name="last_name" id="last_name" class="form-input" required>
                </div>
                <div class="">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-input" required>
                </div>
                <div class="">
                    <label for="phone">Téléphone :</label>
                    <input type="tel" name="phone" id="phone" class="form-input" required>
                </div>
                <div class="">
                    <label for="demande">Demande :</label>
                    <textarea name="demande" id="demande" class="form-input"></textarea>
                </div>

                <div class="">
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="mot_de_passe" class="form-input" required>
                </div>
                <div class="">
                    <label for="confirm_password">Confirmer le mot de passe :</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-input" required>
                </div>
                <div class="">
                    <label for="kbis">Kbis :</label>
                    <input type="file" name="kbis" id="kbis" class="form-input required>
                </div>
                <div class="">
                    <label for="attestation_assurance">Attestation d'assurance :</label>
                    <input type="file" name="attestation_assurance" id="attestation_assurance" class="form-input" required>
                </div>
                <div class="d-flex jc-c my-3">
                    <button type="submit" class="">Enregistrer</button>
                </div>
            </div>
        </form>

    </div>
    <?php include('../inc/footerAdmin.inc.php'); ?>
</body>

</html>