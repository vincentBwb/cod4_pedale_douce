
<main>

    <div class="profile">

        <div class="list align-center orangeBtn">

            <h2>Information</h2>
            <p class="justify">
                La société CIPED requiert vos coordonnées banquaire à titre de garantie et non pour
                effectuer des achats.
            </p>
            <p class="justify">Merci de votre compréhension.</p>

        </div>

        <form class="edit" method="POST" action="/bluecard">

            <div>

                <h2 class="editTitle"><?= $viewCfg["contentTitle"]; ?></h2>

                <div class="editField">

                    <label for="idFn" class="interline">First name</label>
                    <input type="text" id="idFn" name="first_name" value="<?= $fields['first_name']; ?>">
                    <p><?= $status['first_name']; ?></p>

                    <label for="idLn" class="interline">Last name</label>
                    <input type="text" id="idLn" name="last_name" value="<?= $fields['last_name']; ?>">
                    <p><?= $status['last_name']; ?></p>

                    <label for="idNum" class="interline">Number</label>
                    <input type="text" id="idNum" name="number" value="<?= $fields['number']; ?>">
                    <p><?= $status['number']; ?></p>

                    <label for="idCryt" class="interline">Cryptogram</label>
                    <input type="text" id="idCryt" name="cryptogram" value="<?= $fields['cryptogram']; ?>">
                    <p><?= $status['cryptogram']; ?></p>

                    <label for="idExpy" class="interline">Expiry</label>
                    <input type="text" id="idExpy" name="expiry" value="<?= $fields['expiry']; ?>" placeholder="<?= date('m/y') ?>">
                    <p><?= $status['expiry']; ?></p>

                </div>

            </div>

            <div class="editPanel">

                <input type="submit" class="classBtn editPanelBtn greenBtn" value="Validate">

            </div>

        </form>

        <div class="legend">
        </div>

    </div>

</main>
