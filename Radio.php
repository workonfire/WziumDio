<?php

require_once "playlists/Playlist.php";
require_once "playlists/RMFPlaylist.php";
require_once "playlists/TubaFMPlaylist.php";

class Radio {

    public string    $id;
    public string    $display_name;
    public array     $playlist_data;
    public ?Playlist $playlist;

    function __construct($id) {
        $this->id = $id;
        $this->display_name = json_decode(file_get_contents("aliases.json"))->aliases->$id;
        $data = json_decode(file_get_contents("sources.json"));
        $this->playlist_data = json_decode(file_get_contents($data->playlists->$id));
        $this->playlist = $this->createPlaylist();
    }

    private function createPlaylist(): ?Playlist {
        switch ($this->id) {
            case "rmf_fm":
            case "rmf_maxxx":
                return new RMFPlaylist($this->playlist_data);
            case "zlote_przeboje":
                return new TubaFMPlaylist($this->playlist_data);
            default:
                return null;
        }
    }

    public static function showListEntries(?Radio $radio): void {
        $aliases = json_decode(file_get_contents("aliases.json"))->aliases;
        foreach ($aliases as $alias=>$full_name) {
            echo '<option value="' . $alias . '"';
            if (isset($radio)) echo $radio->id == $alias ? 'selected=\"selected\"' : '';
            echo "   >$full_name</option>";
        }
    }

}