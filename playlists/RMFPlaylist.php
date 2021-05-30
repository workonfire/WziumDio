<?php


class RMFPlaylist implements Playlist {
    private array $playlist_data;

    function __construct($playlist_data) {
        $this->playlist_data = $playlist_data;
    }

    public function show(): void {
        foreach ($this->playlist_data as $song) {
            if ($song->order >= 0) {
                $song->lenght = $song->lenght != '' ? '⌛ ' . gmdate('i:s', $song->lenght) : $song->lenght;
                if ($song->author == "FAKTY RMF FM") {
                    $song->title = "FAKTY";
                    $song->author = "RMF FM";
                    $song->coverBigUrl = 'assets/fakty_rmf_fm.jpg';
                    $song->recordTitle = "<a href='https://www.rmf24.pl/fakty' class='footerlink'>Kliknij</a>, 
                                          aby poczytać";
                    $song->lenght = "⌛ 2-5 min";
                }
                else $song->coverBigUrl = $song->coverUrl == '' ? "assets/default.png" : $song->coverBigUrl;
                $song->title = Radio::sanitizeString($song->title);
                $song->author = Radio::sanitizeString($song->author);
                echo "
                      <div class='song-banner'>
                      
                      </div>
                      <div class='songinfo'>
                          <input
                              type='image'
                              src='$song->coverBigUrl'
                              class='albumart'
                              alt='albumart'
                              onclick='showSongMenu(\"$song->author\", \"$song->title\", \"$song->coverBigUrl\")'
                          />
                          <div>
                              <span class='title'>$song->title</span> <br>
                              <span class='author'>$song->author</span> <br>
                              <span class='album'>$song->recordTitle</span> <br>
                              <span class='length'>$song->lenght</span> <br>
                              <span class='start'>▶ <b>$song->start</b></span> <br>
                          </div>
                      </div>
                      <hr>
                      ";
            }
        }
    }
}
