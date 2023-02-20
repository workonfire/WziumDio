<?php


class RMFPlaylist implements Playlist {
    private array $playlist_data;

    function __construct($playlist_data) {
        $this->playlist_data = $playlist_data;
    }

    public function show(): void {
        foreach ($this->playlist_data as $song) {
            if ($song->order >= 0) {
                $song->lenght = $song->lenght != ''
                    ? '<i class="fas fa-play-circle"></i> ' . gmdate('i:s', $song->lenght)
                    : $song->lenght;
                if ($song->author == "FAKTY RMF FM") {
                    $song->title = "FAKTY";
                    $song->author = "RMF FM";
                    $song->coverBigUrl = "assets/fakty_rmf_fm.jpg";
                    $song->recordTitle = "<a href='https://www.rmf24.pl/fakty'>Kliknij</a>,
                                          aby poczytać";
                    $song->lenght = '<i class="fas fa-hourglass-half"></i> 2-5 min';
                }
                else $song->coverBigUrl = $song->coverUrl == '' ? "assets/default.png" : $song->coverBigUrl;
                $song_start_time_raw = explode(':', $song->start);
                $song_start_time = $song_start_time_raw[0] . ":" . $song_start_time_raw[1];
                echo "
                      <div class='song-info-background' style='background: url($song->coverBigUrl) no-repeat; background-size: cover'>
                      <div class='song-info'>
                      <img src='$song->coverBigUrl' class='album-art' alt='Okładka albumu' />
                          <div>
                              <span class='title'>$song->title</span> <br>
                              <span class='author'>$song->author</span> <br>
                              <span class='album'>$song->recordTitle</span> <br>
                              <p>
                                  <span class='start'><i class='fas fa-clock'></i> <b>$song_start_time</b></span> &nbsp;
                                  <span class='length'>$song->lenght</span>
                              </p>
                          </div>
                      </div>
                      </div>
                      <br> <br>
                      ";
            }
        }
    }
}
