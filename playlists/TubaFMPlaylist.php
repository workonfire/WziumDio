<?php


class TubaFMPlaylist implements Playlist {
    private array $playlist_data;

    function __construct($playlist_data) {
        $this->playlist_data = $playlist_data;
    }

    public function show(): void {
        foreach ($this->playlist_data as $song) {
            $song->song_title = Radio::sanitizeString($song->song_title);
            $song->artist_name = Radio::sanitizeString($song->artist_name);
            echo "
                 <div class='songinfo'>
                     <input
                        type='image'
                        src='$song->album_full_image'
                        class='albumart'
                        alt='albumart'
                        onclick='showSongMenu(\"$song->artist_name\", \"$song->song_title\", \"$song->album_full_image\")'
                     />
                     <div>
                         <span class='title'>$song->song_title</span> <br>
                         <span class='author'>$song->artist_name</span> <br>
                         <span class='album'>$song->album_title</span> <br>
                         <span class='year'>$song->album_year</span> <br>
                     </div>
                 </div>
                 <hr>
                 ";
        }
    }
}
