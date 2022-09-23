<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" type="text/css" href="/styles/common.css"> -->
        <!-- <link rel="stylesheet" type="text/css" href="/styles/main.css"> -->
        <title>Test page</title>

    </head>

    <body>

        <header>

            <h1>Test page</h1>

        </header>

        <main>

            <?php

                //? ################################################################################

                // Create The First Key
                $firstKey = base64_encode(openssl_random_pseudo_bytes(32));
                echo("First key (" . gettype($firstKey) . "): $firstKey<br>");
                // 50x0jPaF3Ir8RyZBlnNUre/F0Dox4F4hVFEBBy9NfkM=

                // Create The Second Key
                $secondKey = base64_encode(openssl_random_pseudo_bytes(64));
                echo("Second key (" . gettype($secondKey) . "): $secondKey<br><br>");
                // iK4Vwh42VUB9zf8Q8cmAaaizcXenn5Y/KxHbWZHOcUTKIqOyyLMtjO992WbrRx6RtPbCZ9Vxda5m8wkO6QsXnQ==

                //? ################################################################################

                $session = \Config\Services::session();
                if ($session->has('userinfo')) {

                    $userInfo = $session->get("userinfo");
                    echo("user info:<br><br>");
                    foreach ($userInfo as $k => $v) {
                        echo("$k: $v (" . gettype($v) . ")<br>");
                    }

                } else {

                    echo("No session data (session closed)<br>");

                }

                //? ################################################################################

                echo("<br>Station count: " . count($stations) . "<br><br>");

                function display($a, $tab) {

                    foreach ($a as $k => $v) {

                        $t = gettype($v);

                        if($t === "array") {

                            echo("$tab$k: [<br>");
                            display($v, $tab ."....");
                            echo("$tab]<br>");
                            
                        } else {

                            echo("$tab$k: $v (" . gettype($v) . ")<br>");

                        }
                        
                    }
                }

                //* Display recursive
                display($stations, "");

                //? ################################################################################

                $mystr = "2021-12";
                $tst = new DateTime($mystr);
                echo("date: ". $tst->format('y-m') . " (" . gettype($tst) . ")");

                //? ################################################################################

            ?>

        </main>

        <footer>
            <p>&copy; <?= date('Y') ?> Pedale Douce / CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?> / <?= strtoupper(ENVIRONMENT) ?> / {elapsed_time} seconds</p>
        </footer>

    </body>

</html>
