<!DOCTYPE html>
<html lang="pl">

<!-- WziumDio by workonfire -->

<head>
    <meta charset="UTF-8">
    <title>WziumDio</title>
    <link rel="icon" type="image/png" href="assets/icon.png"/>
    <link rel="stylesheet" href="style.css">
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
                    echo isset($_GET['radio_station']) && $_GET['radio_station'] == 'rmf_fm'
                        ? "selected=\"selected\""
                        : ''
                ?>>RMF FM</option>
                <option value="zlote_przeboje" <?php
                    echo isset($_GET['radio_station']) && $_GET['radio_station'] == 'zlote_przeboje'
                        ? "selected=\"selected\""
                        : ''
                ?>>Złote Przeboje</option>
            </select>
            <br> <br>
            <input type="submit" value="Sprawdź!">
        </p>
    </form>

    <?php
        if (isset($_GET['radio_station'])) {
            $radio_station = $_GET['radio_station'];

            switch ($radio_station) {
                case "rmf_fm":
                    $data_link = "https://www.rmfon.pl/stacje/playlista_5.json.txt";
                    break;
                case "zlote_przeboje":
                    $data_link = "https://ssl.static.fm.tuba.pl/api3/onStation?format=json&id=8936";
                    break;
                default:
                    $data_link = null;
            }

            $data = json_decode(file_get_contents($data_link));

            switch ($radio_station) {
                case "rmf_fm":
                    foreach ($data as $song) {
                        $song->lenght = $song->lenght != '' ? '⌛ '.gmdate('i:s', $song->lenght) : $song->lenght;
                        $song->coverUrl = $song->coverUrl == '' ? "assets/default.png" : $song->coverUrl;
                        if ($song->order == 0) echo "<span class='now_playing'>▶ TERAZ GRANE</span><br><br>";
                        echo "
                            <div class='songinfo'>
                                <img src='{$song->coverUrl}' class='albumart' alt='albumart' />
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
                    break;
                case "zlote_przeboje":
                    echo "<span class='now_playing'>▶ TERAZ GRANE</span><br><br>";
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
