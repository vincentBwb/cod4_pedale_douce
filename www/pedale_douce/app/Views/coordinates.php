
<main>

    <div class="profile">

        <form class="edit" method="POST" action="/coordinates">

            <div>

                <h2 class="editTitle"><?= $viewCfg["contentTitle"]; ?></h2>

                <div class="editField">

                    <label for="idPx" class="interline">Position X</label>
                    <input type="text" id="idPx" name="position_x" value="<?= $fields['position_x']; ?>">
                    <p><?= $status['position_x']; ?></p>

                    <label for="idPy" class="interline">Position Y</label>
                    <input type="text" id="idPy" name="position_y" value="<?= $fields['position_y']; ?>">
                    <p><?= $status['position_y']; ?></p>

                </div>

            </div>

            <div class="editPanel">

                <input type="submit" class="classBtn editPanelBtn greenBtn" value="<?= $viewCfg["submitBtn"]; ?>">

            </div>

        </form>

    </div>

</main>
