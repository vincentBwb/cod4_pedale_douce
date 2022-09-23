
<main>

    <div class="profile">

        <div class="list">
            <h2>Stations</h2>
            <?php
                for ($i = 0 ; $i < count($stations) ; $i++) {
                    $name = $stations[$i]["name"];
                    $uid = $stations[$i]["uid"];
                    $select = $stations[$i]["selected"] ? " selected" : "";
                    echo("<p>#$uid $name</p>");
                }
            ?>

        </div>

        <form class="map" method="POST" action="/bike">

            <img src="<?= $mapFile; ?>" alt="Map Picture" width="500" height="350">

            <div>

                <h2 class="editTitle"><?= $viewCfg["contentTitle"]; ?></h2>

                <div class="editField">

                    <select name="station">

                        <?php
                            for ($i = 0 ; $i < count($stations) ; $i++) {
                                $name = $stations[$i]["name"];
                                $select = $stations[$i]["selected"] ? " selected" : "";
                                if ($stations[$i]["stat"] < 2) {
                                    //* Available stations only
                                    echo("<option value='$i'$select>$name</option>");
                                }
                            }
                        ?>
                        
                    </select>

                </div>

            </div>

            <div class="editPanel">

                <input type="submit" class="classBtn editPanelBtn greenBtn" value="<?= $viewCfg["submitBtn"]; ?>">

            </div>

        </form>

        <div class="legend">
            <h2>Legend</h2>
            <p class="greenBtn">Nearest station</p>
            <p class="blueBtn">Station with bike available</p>
            <p class="redBtn">Station with bike unavailable</p>
            <p class="yellowBtn">You are here</p>
    
        </div>
    
    </div>

</main>
