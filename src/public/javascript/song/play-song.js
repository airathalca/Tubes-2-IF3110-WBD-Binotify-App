let hasPlayed = false;
let banned = false;

const audioPlayer = document.querySelector(".audio-player");

const playButton = document.querySelector(".button-play");
const pauseButton = document.querySelector(".button-pause");
const progressBar = document.querySelector("#progress-bar");
const currDuration = document.querySelector("#curr-duration");
const finalDuration = document.querySelector("#curr-duration");

function padDigits(number, digits) {
    return (
        Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number
    );
}

if (audioPlayer) {
    playButton.addEventListener("click", () => {
        if (!banned) {
            pauseButton.style.display = "grid";
            playButton.style.display = "none";
            audioPlayer.play();
        } else {
            audioPlayer.pause();
            alert(
                "You have reached the limit of 3 songs per day. Please try again tomorrow."
            );
        }
    });

    pauseButton.addEventListener("click", () => {
        pauseButton.style.display = "none";
        playButton.style.display = "grid";
        audioPlayer.pause();
    });

    audioPlayer.addEventListener("timeupdate", () => {
        const percent = (audioPlayer.currentTime / audioPlayer.duration) * 100;

        progressBar.value = percent;

        const seconds = Math.floor(audioPlayer.currentTime);

        currDuration.textContent = `${Math.floor(seconds / 60)}:${padDigits(
            seconds % 60,
            2
        )}`;
    });

    progressBar.addEventListener("input", (e) => {
        const seconds = (e.target.value / 100) * audioPlayer.duration;
        currDuration.textContent = `${Math.floor(seconds / 60)}:${padDigits(
            Math.floor(seconds) % 60,
            2
        )}`;

        audioPlayer.currentTime = seconds;
    });

    audioPlayer.addEventListener("play", () => {
        if (!hasPlayed) {
            hasPlayed = true;
            if (USERNAME === "") {
                if (SONG_COUNT >= MAX_SONG_COUNT) {
                    audioPlayer.pause();
                    alert(
                        "You have reached the limit of 3 songs per day. Please try again tomorrow."
                    );
                    banned = true;
                } else {
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "/public/song/countLimit");
                    const formData = new FormData();
                    formData.append("csrf_token", CSRF_TOKEN);
                    xhr.send(formData);

                    xhr.onreadystatechange = function () {
                        if (this.readyState === XMLHttpRequest.DONE) {
                            if (this.status === 200) {
                                const data = JSON.parse(this.responseText);
                                if (data.status !== true) {
                                    audioPlayer.pause();
                                    window.alert(
                                        "You have reached the limit of 3 songs per day. Please try again tomorrow."
                                    );
                                }
                            }
                        }
                    };
                }
            }
        }
    });
}
