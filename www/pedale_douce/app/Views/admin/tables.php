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
                <h1>Select a table</h1>
            </div>

            <div class="hdrRight">
                <div class="userSection">
                    <div class="userPanel">
                        <a href='/' class='classBtn greenBtn'>Return</a>
                    </div>
                </div>
            </div>

        </header>

        <main class="profile">

            <div class="edit">

                <a href='/admin/users/list' class='classBtn blueBtn'>Users</a>
                <a href='/admin/stations/list' class='classBtn blueBtn'>Stations</a>
                <a href='/admin/bikes/list' class='classBtn blueBtn'>Bikes</a>
                <a href='/admin/bornes/list' class='classBtn blueBtn'>Bornes</a>
                <a href='/admin/blue_cards/list' class='classBtn blueBtn'>Blue cards</a>

            </div>

        </main>

        <footer>
            <p>&copy; <?= date('Y') ?> Pedale Douce / CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?> / <?= strtoupper(ENVIRONMENT) ?> / {elapsed_time} seconds</p>
        </footer>

    </body>

</html>
