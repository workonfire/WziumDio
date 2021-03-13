function timestampDiff(firstTimestamp, secondTimestamp) {
    function convertToSeconds(timestamp) {
        let splitted = timestamp.split(':');
        return (+splitted[0]) * 60 * 60 + (+splitted[1]) * 60 + (+splitted[2]);
    }
    return convertToSeconds(secondTimestamp) - convertToSeconds(firstTimestamp);
}

const startTimes = document.getElementsByClassName('start');

if (startTimes.length > 0) {
    const currentTimestamp = new Date().toTimeString().split(' ')[0];
    const secondSongStartTimestamp = startTimes.item(1).innerHTML
        .replace(/(<([^>]+)>)/gi, '')
        .replace('▶ ', '');
    const timeDiff = timestampDiff(currentTimestamp, secondSongStartTimestamp);
    console.debug("Różnica pomiędzy czasem startu następnej piosenki, a czasem systemowym: " + timeDiff + " s");
    const userListening = new URL(window.location.href).searchParams.get('wanna_listen') === 'on';
    if (timeDiff > 5 && !userListening)
        setTimeout(() => window.location.reload(), timeDiff * 1000);
}