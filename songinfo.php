<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/icon.png"/>
    <link rel="stylesheet" href="fonts.css">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WziumDio - Utwór</title>
</head>
<body>
    <div class="header">
        <span id="wzium">Wzium</span><span id="dio">Di</span><img id="vinyl" src="assets/vinyl.png" alt="vinyl">
    </div>

    <?php
        require_once "lyrics.php";

        $artist = null;
        $title = null;
        $art = null;

        if (!isset($_GET['artist']) || !isset($_GET['title']) || !isset($_GET['art']))
            header('Location: index.php');
        else {
            $artist = $_GET['artist'];
            $title = $_GET['title'];
            $art = $_GET['art'];
        }
    ?>

    <br> <br> <br>
    <div id="song-banner">
        <script type="text/javascript">
            document.getElementById('song-banner').style.backgroundImage =
                "url('" + new URL(window.location.href).searchParams.get('art') + "')";
        </script>
    </div>

    <div id="song-info-on-banner">
        <?php
            echo "<img src='$art' alt='albumart' id='album-art-on-banner' />";
            echo "<div id='song-info-next-to-banner'>
                     <span class='title'>$title</span> <br>
                     <span class='author'>$artist</span> <br>
                  </div>";
        ?>
    </div>

    <div class="song-details">
        <p class="question">Informacje</p>
        <?php echo getLyrics($artist, $title) ?>
        <br>
    </div>

    <br> <br>
    <div class="footer">
        Stworzono przez <a href="https://github.com/workonfire" class="footerlink">workonfire</a>
    </div>
</body>
</html>