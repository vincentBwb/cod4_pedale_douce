<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/styles/common.css">
        <link rel="stylesheet" type="text/css" href="/styles/main.css">
        <title>Admin</title>

    </head>

    <body>

        <header>

            <div class="hdrLeft">
            </div>

            <div class="hdrCenter">
                <h1><?= "Delete " . str_replace("_", " ", substr($table, 0, -1)); ?></h1>
            </div>

            <div class="hdrRight">
                <div class="userSection">
                    <div class="userPanel">
                        <a href='/admin' class='classBtn orangeBtn'>Admin</a>
                        <a href='/' class='classBtn greenBtn'>Return</a>
                        <a href='/admin/<?= $table ?>/list' class='classBtn blueBtn'><?= str_replace("_", " ", ucfirst($table)); ?></a>
                    </div>
                </div>
            </div>

        </header>

        <main>

            <?php

                echo("<h2>Delete uid ($uid)</h2>");

            ?>

        </main>

        <footer>
            <p>&copy; <?= date('Y') ?> Pedale Douce / CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?> / <?= strtoupper(ENVIRONMENT) ?> / {elapsed_time} seconds</p>
        </footer>

    </body>

</html>
