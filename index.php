<!DOCTYPE html>
<html lang="pl">

<!-- WziumDio by workonfire -->
<!-- https://workonfi.re/?project=WziumDio -->

<?php
    require_once "Radio.php";
    if (isset($_GET['radio_station'])) $radio = new Radio($_GET['radio_station']);
?>

<head>
    <meta charset="UTF-8">
    <title>WziumDio <?php
            if (isset($radio)) $full_radio_name = $radio->display_name;
            echo isset($full_radio_name) ? "- " . $full_radio_name : '';
        ?></title>
    <link rel="icon" type="image/png" href="assets/icon.png"/>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="header">
        <span id="wzium">Wzium</span><span id="dio">Dio</span>
    </div>
    <p class="info">📻 Sprawdź, co będzie grane!</p>

    <form action="index.php" method="get">
        <p id="select_radio">
            <label for="radio_stations">Stacja radiowa:</label>
            <select id="radio_stations" name="radio_station">
                <?php
                    Radio::showListEntries(isset($radio) ? $radio : null);
                ?>
            </select>
        </p>
        <div>
            <input type="checkbox" id="wanna_listen" name="wanna_listen"
                <?php
                    echo isset($_GET['wanna_listen']) ? 'checked="checked"' : '';
                ?>>
            <label for="wanna_listen">Chcę posłuchać!</label>
        </div>
        <br>
        <input type="submit" value="Sprawdź!">
        <br> <br>
    </form>

    <?php

        if (isset($_GET['wanna_listen']) && isset($radio) && $_GET['wanna_listen'] == 'on')
            $radio->showPlayer();

        if (isset($radio)) {
            echo "<span class='now_playing'>▶ TERAZ GRANE</span><br><br>";
            $radio->showPlaylist();
        }
    ?>

<div class="footer">
    Created by <a href="https://github.com/workonfire" id="footerlink">workonfire</a>
</div>

</body>

</html>
