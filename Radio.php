<?php

require_once "implementations/RMFBasedPlaylist.php";
require_once "implementations/ZlotePrzebojePlaylist.php";

class Radio {
    use RMFBasedPlaylist {
        RMFBasedPlaylist::showPlaylist as protected showRMFPlaylist;
    }

    use ZlotePrzebojePlaylist {
        ZlotePrzebojePlaylist::showPlaylist as protected showZlotePrzebojePlaylist;
    }

    public string $id;
    public string $display_name;
    public string $stream_link;
    public array $playlist_data;

    function __construct($id) {
        $this->id = $id;
        $this->display_name = json_decode(file_get_contents("aliases.json"))->aliases->$id;
        $data = json_decode(file_get_contents("sources.json"));
        $this->stream_link = $data->streams->$id;
        $this->playlist_data = json_decode(file_get_contents($data->playlists->$id));
    }

    public function showPlayer(): void {
        echo "<audio id='player' controls autoplay src='{$this->stream_link}'></audio> <br><br>";
        echo "
              <script>
                  let audio = document.getElementById('player');
                  audio.volume = 0.5;
              </script>
              ";
    }

    public function showPlaylist(): void {
        switch ($this->id) {
            case "rmf_fm":
            case "rmf_maxxx":
                $this->showRMFPlaylist($this->playlist_data);
                break;
            case "zlote_przeboje":
                $this->showZlotePrzebojePlaylist($this->playlist_data);
                break;
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