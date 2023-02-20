<?php


class TubaFMPlaylist implements Playlist {
    private array $playlist_data;

    function __construct($playlist_data) {
        $this->playlist_data = $playlist_data;
    }

    public function show(): void {
        foreach ($this->playlist_data as $song) {
            echo "
                 <div class='song-info-background' style='background: url($song->album_full_image) no-repeat; background-size: cover'>
                 <div class='song-info'>
                     <img src='$song->album_full_image' class='album-art' alt='album-art' />
                     <div>
                         <span class='title'>$song->song_title</span> <br>
                         <span class='author'>$song->artist_name</span> <br>
                         <span class='album'>$song->album_title</span> <br>
                         <span class='year'>$song->album_year</span> <br>
                     </div>
                 </div>
                 </div>
                 <br> <br>
                 ";
        }
    }
}
