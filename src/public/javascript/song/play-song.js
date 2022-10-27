const audioPlayer = document.querySelector('.audio-player');

if (audioPlayer) {
    audioPlayer.addEventListener('play', () => {
        if (username === '') {
            if (SONG_COUNT >= MAX_SONG_COUNT) {
                audioPlayer.pause();
                alert('You have reached the limit of 3 songs per day. Please try again tomorrow.');
            }
            else {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/public/song/countLimit');
    
                const formData = new FormData();
                formData.append("csrf_token", CSRF_TOKEN);
                xhr.send(formData);
    
                xhr.onreadystatechange = function () {
                    if (this.readyState === XMLHttpRequest.DONE) {
                        if (this.status === 200) {
                            const data = JSON.parse(this.responseText);
                            if (data.status !== true) {
                                audioPlayer.pause();
                                window.alert('You have reached the limit of 3 songs per day. Please try again tomorrow.');
                            }
                        }
                    }
                }
            }
        }
    });
};