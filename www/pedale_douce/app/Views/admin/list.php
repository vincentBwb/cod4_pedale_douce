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
                <h1><?= str_replace("_", " ", ucfirst($table)) . " list (" . count($records) . ")"; ?></h1>
            </div>

            <div class="hdrRight">
                <div class="userSection">
                    <div class="userPanel">
                        <a href='/admin' class='classBtn orangeBtn'>Admin</a>
                        <a href='/' class='classBtn greenBtn'>Return</a>
                    </div>
                </div>
            </div>

        </header>

        <main>

            <?php

                $createBtn = str_replace("_", " ", substr($table, 0, -1));
                echo("<a href='/admin/$table/create'  class='classBtn yellowBtn'>Create $createBtn</a>");

                echo("<table class='interline'>");

                    echo("<thead>");
                        echo("<tr>");
                            foreach ($columns as $column) {
                                echo("<td>$column</td>");
                            }
                        echo("</tr>");
                    echo("</thead>");

                    echo("<tbody>");
                    foreach ($records as $record) {
                        echo("<tr>");
                            foreach ($record as $k => $v) {
                                echo("<td>$v</td>");
                            }
                            $recordId = $record["uid"];
                            echo("<td><a href='/admin/$table/edit/$recordId' class='greenBtn decoNone'>Edit</a></td>");
                            echo("<td><a href='/admin/$table/del/$recordId' class='redBtn decoNone'>Delete</a></td>");
                        echo("</tr>");
                    }
                    echo("</tbody>");

                echo("</table>");

            ?>

        </main>

        <footer>
            <p>&copy; <?= date('Y') ?> Pedale Douce / CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?> / <?= strtoupper(ENVIRONMENT) ?> / {elapsed_time} seconds</p>
        </footer>

    </body>

</html>
