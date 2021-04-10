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
    }
}
