<?php

require_once "playlists/Playlist.php";
require_once "playlists/RMFPlaylist.php";
require_once "playlists/TubaFMPlaylist.php";

include_once "vendor/autoload.php";

class Radio {

    public  string    $id;
    public  string    $display_name;
    public  string    $stream_link;
    public  array     $playlist_data;
    public  ?Playlist $playlist;
    private array     $radio_data;

    function __construct($id) {
        $this->id = $id;
        $this->radio_data = json_decode(file_get_contents('config.json'), true)['config'];
        $this->display_name = $this->radio_data['aliases'][$id];
        $this->stream_link = $this->radio_data['sources']['streams'][$id];
        $this->playlist_data = json_decode(file_get_contents($this->radio_data['sources']['playlists'][$id]));
        $this->playlist = $this->createPlaylist();
    }

    private function createPlaylist(): ?Playlist {
        switch ($this->id) {
            case 'rmf_fm':
            case 'rmf_maxxx':
                return new RMFPlaylist($this->playlist_data);
            case 'zlote_przeboje':
                return new TubaFMPlaylist($this->playlist_data);
            default:
                return null;
        }
    }

    public function showPlayer(): void {
        echo "<audio id='player' controls src='$this->stream_link'></audio> <br><br>";
        echo "<script type='text/javascript' src='scripts/lower_player_volume.js'></script>";
    }

    public static function showListEntries(?Radio $radio): void {
        $aliases = json_decode(file_get_contents('config.json'), true)['config']['aliases'];
        foreach ($aliases as $alias=>$full_name) {
            echo '<option value="' . $alias . '"';
            if (isset($radio)) echo $radio->id == $alias ? 'selected=\"selected\"' : '';
            echo "   >$full_name</option>";
        }
    }

    public static function sanitizeString(string $original): string {
        $original = str_replace('\'', '', $original);
        $original = str_replace('&', 'and', $original);
        return $original;
    }

}