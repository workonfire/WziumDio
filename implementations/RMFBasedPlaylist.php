<?php

trait RMFBasedPlaylist {
    public function showPlaylist($playlist_data): void {
        foreach ($playlist_data as $song) {
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