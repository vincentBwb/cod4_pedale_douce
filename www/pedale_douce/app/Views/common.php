<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/styles/common.css">
        <link rel="stylesheet" type="text/css" href="/styles/main.css">
        <title><?= $viewCfg["title"]; ?></title>
    </head>
    <body>
        <header>
            <div class="hdrLeft">
                <img id="idAvatarImg" src="/assets/bwb.png" alt="Header Avatar">
            </div>

            <div class="hdrCenter">
                <h1>Pedale Douce</h1>
            </div>

            <div class="hdrRight">
                <div class="userSection">
                    <h3 id="idNameHeader"><?= $viewCfg["menuTitle"]; ?></h3>
                    <div class="userPanel">
                        <?php
                            foreach ($viewCfg["btn"] as $btn) {
                                $name = $btn["name"];
                                $link = $btn["link"];
                                $color = $btn["color"];
                                // $hidden = $btn["hidden"] ? " hidden" : "";
                                echo("<a href='$link' class='classBtn $color'>$name</a>");
                            }
                        ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- main -->
        <?= view($viewCfg["content"]); ?>
        <!-- /main -->

        <footer>
            <p>&copy; <?= date('Y') ?> Pedale Douce / CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?> / <?= strtoupper(ENVIRONMENT) ?> / {elapsed_time} seconds</p>
        </footer>

    </body>

</html>
