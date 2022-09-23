
<main>

    <div class="profile">

        <form class="edit" method="POST" action="/signup">

            <div>

                <h2 class="editTitle"><?= $viewCfg["contentTitle"]; ?></h2>

                <div class="editField">

                    <label for="idUsr" class="interline">Pseudo</label>
                    <input type="text" id="idUsr" name="pseudo" value="<?= $fields['pseudo']; ?>">
                    <p><?= $status['pseudo']; ?></p>

                    <label for="idMl" class="interline">Email</label>
                    <input type="text" id="idMl" name="email" value="<?= $fields['email']; ?>">
                    <p><?= $status['email']; ?></p>

                    <label for="idMlChk">Email confirmation</label>
                    <input type="text" id="idMlChk" name="email_confirmation" value="<?= $fields['email_confirmation']; ?>">
                    <p><?= $status['email_confirmation']; ?></p>

                    <label for="idPw" class="interline">Password</label>
                    <input type="password" id="idPw" name="password" value="<?= $fields['password']; ?>">
                    <p><?= $status['password']; ?></p>

                    <label for="idPwChk">Password confirmation</label>
                    <input type="password" id="idPwChk" name="password_confirmation" value="<?= $fields['password_confirmation']; ?>">
                    <p><?= $status['password_confirmation']; ?></p>

                </div>

            </div>

            <div class="editPanel">

                <input type="submit" class="classBtn editPanelBtn blueBtn" value="Sign-Up">

            </div>

        </form>

    </div>

</main>
