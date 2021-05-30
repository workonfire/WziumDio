function showSongMenu(artist, title, albumArt) {
    artist.replaceAll(/'/g, "\\'");
    title.replaceAll(/'/g, "\\'");
    window.location.href = "songinfo.php?artist=" + artist + "&title=" + title + "&art=" + albumArt;
}
