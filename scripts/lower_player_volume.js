const volume = localStorage.getItem('volume');

if (volume === null) localStorage.setItem('volume', 0.5.toString());
document.getElementById('player').volume = volume === null ? 0.5 : volume;

document.getElementById('player').onvolumechange = () => {
    const currentVolume = document.getElementById('player').volume;
    localStorage.setItem('volume', currentVolume);
};