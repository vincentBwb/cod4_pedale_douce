
<main>

    <div class="profile">

        <form class="edit" method="POST" action="/login">

            <div>

                <h2 class="editTitle"><?= $viewCfg["contentTitle"]; ?></h2>

                <div class="editField">

                    <label for="idUsr">Pseudo</label>
                    <input type="text" id="idUsr" name="pseudo" value="<?= $fields['pseudo']; ?>">
                    <p><?= $status['pseudo']; ?></p>

                    <label for="idPsw" class="interline">Password</label>
                    <input type="password" id="idPsw" name="password" value="<?= $fields['password']; ?>">
                    <p><?= $status['password']; ?></p>

                </div>

            </div>

            <div class="editPanel">

                <input type="submit" class="classBtn editPanelBtn greenBtn" value="Log-In">

            </div>

        </form>

    </div>

</main>
