<!DOCTYPE html>
<html lang="pl">

<!-- WziumDio by workonfire -->

<head>
    <meta charset="UTF-8">
    <title>WziumDio <?php
            if (isset($_GET['radio_station'])) {
                switch ($_GET['radio_station']) {
                    case "rmf_fm":
                        $full_radio_name = "RMF FM"; break;
                    case "zlote_przeboje":
                        $full_radio_name = "Złote Przeboje"; break;
                }
                echo isset($full_radio_name) ? "- ".$full_radio_name : '';
            }
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
                <option value="rmf_fm" <?php
                    if (isset($_GET['radio_station']))
                        echo $_GET['radio_station'] == 'rmf_fm' ? 'selected="selected"' : '';
                ?>>RMF FM</option>
                <option value="zlote_przeboje" <?php
                    if (isset($_GET['radio_station']))
                        echo $_GET['radio_station'] == 'zlote_przeboje' ? 'selected="selected"' : '';
                ?>>Złote Przeboje</option>
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
        if (isset($_GET['radio_station'])) {
            $radio_station = $_GET['radio_station'];

            switch ($radio_station) {
                case "rmf_fm":
                    $data_link = "https://www.rmfon.pl/stacje/playlista_5.json.txt"; break;
                case "zlote_przeboje":
                    $data_link = "https://ssl.static.fm.tuba.pl/api3/onStation?format=json&id=8936"; break;
                default:
                    $data_link = null;
            }

            $data = json_decode(file_get_contents($data_link));
            $now_playing = "<span class='now_playing'>▶ TERAZ GRANE</span><br><br>";

            function showPlayer($radio_station) {
                switch ($radio_station) {
                    case "rmf_fm":
                        $player_link = "https://195.150.20.9/rmf_fm"; break;
                    case "zlote_przeboje":
                        $player_link = "https://pl2-play.adtonos.com/zote-przeboje"; break;
                    default:
                        $player_link = '';
                }
                echo "<audio id='player' controls autoplay src='{$player_link}'></audio> <br><br>";
                echo "
                    <script>
                        let audio = document.getElementById('player');
                        audio.volume = 0.5;
                    </script>
                ";
            }

            if (isset($_GET['wanna_listen']) && $_GET['wanna_listen'] == 'on')
                showPlayer($radio_station);

            echo $now_playing;
            switch ($radio_station) {
                case "rmf_fm":
                    foreach ($data as $song) {
                        if ($song->order >= 0) {
                            $song->lenght = $song->lenght != '' ? '⌛ ' . gmdate('i:s', $song->lenght) : $song->lenght;
                            $song->coverBigUrl = $song->coverUrl == '' ? "assets/default.png" : $song->coverBigUrl;
                            echo "
                            <div class='songinfo'>
                                <img src='{$song->coverBigUrl}' class='albumart' alt='albumart' />
                                <div>
                                    <span class='title'>{$song->title}</span> <br>
                                    <span class='author'>{$song->author}</span> <br>
                                    <span class='album'>{$song->recordTitle}</span> <br>
                                    <span class='length'>{$song->lenght}</span> <br>
                                    <span class='start'>▶ <b>{$song->start}</b></span> <br>
                                </div>
                            </div>
                            <hr>
                            ";
                        }
                    }
                    break;
                case "zlote_przeboje":
                    foreach ($data as $song) {
                        echo "
                            <div class='songinfo'>
                                <img src='{$song->album_full_image}' class='albumart' alt='albumart' />
                                <div>
                                    <span class='title'>{$song->song_title}</span> <br>
                                    <span class='author'>{$song->artist_name}</span> <br>
                                    <span class='album'>{$song->album_title}</span> <br>
                                    <span class='year'>{$song->album_year}</span> <br>
                                </div>
                            </div>
                            <hr>
                        ";
                    }
                    break;
            }
        }
    ?>

<div class="footer">
    Created by <a href="https://github.com/workonfire" id="footerlink">workonfire</a>
</div>

</body>

</html>
