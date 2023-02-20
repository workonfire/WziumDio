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
    <script src="https://kit.fontawesome.com/07fe25146f.js" crossorigin="anonymous"></script>
    <title>WziumDio <?php
            if (isset($radio)) $full_radio_name = $radio->display_name;
            echo isset($full_radio_name) ? "- " . $full_radio_name : '';
        ?></title>
    <link rel="icon" type="image/png" href="assets/icon.png"/>
    <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="fonts.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <header>
        <span id="wzium">wzium</span><span id="dio">dio</span>
    </header>

    <form action="index.php" method="get">
        <p id="select-radio">
            <label for="radio-stations">Stacja radiowa:</label>
            <select id="radio-stations" name="radio_station">
                <?php
                    Radio::showListEntries($radio ?? null);
                ?>
            </select>
        </p>
        <button type="submit" class="mdc-button mdc-button--raised mdc-button--leading">
            <span class="mdc-button__ripple"></span>
            <i class="material-icons mdc-button__icon" aria-hidden="true">
                queue_music
            </i>
            <span class="mdc-button__label">Sprawdź playlistę</span>
        </button>
        <br> <br>
    </form>

    <?php
        if (isset($radio)) $radio->playlist->show();
    ?>

    <footer>
        Stworzono przez <a href="https://workonfi.re">workonfire</a> <br><br>
    </footer>

</body>

</html>
