<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

use Genius\ConnectGeniusException;
use Genius\Genius;
use Http\Message\Authentication\Bearer;
use voku\helper\HtmlDomParser;

require_once('vendor/autoload.php');

function getLyrics(string $artist, string $song_name): string {
    $authentication = new Bearer(file_get_contents('token.txt'));
    try {
        $genius = new Genius($authentication);
        $song_url = $genius->getSearchResource()->get($artist . " " . $song_name)->response->hits[0]->result->url;
        return $song_url;
    } catch (ConnectGeniusException $e) {
        die("Something went wrong.");
    }
}
