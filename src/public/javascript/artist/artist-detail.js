// Fetch data from backend
let songsData = [];
let errorParagraph = document.querySelector(".error-text");
let songsTable = document.querySelector(".songs-table");
let audioPlayer = document.querySelector(".audio-player");
let audioSource = document.querySelector(".audio-src");
let audioPlayerContainer = document.querySelector(".audio-player-container");
let currDuration = document.querySelector("#curr-duration");
let finalDuration = document.querySelector("#final-duration");
let playButton = document.querySelector(".button-play");
let pauseButton = document.querySelector(".button-pause");
let stopButton = document.querySelector(".button-stop");
let progressBar = document.querySelector("#progress-bar");
let audioTitle = document.querySelector(".audio-title");

function pad(n, width, z) {
  z = z || "0";
  n = n + "";
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

const formatSeconds = (seconds) => {
  return `${Math.floor(seconds / 60)}:${pad(
    (seconds % 60).toString(),
    2,
    "0"
  )}`;
};

if (audioPlayer) {
  playButton.addEventListener("click", () => {
    pauseButton.style.display = "grid";
    playButton.style.display = "none";
    audioPlayer.play();
  });

  pauseButton.addEventListener("click", () => {
    pauseButton.style.display = "none";
    playButton.style.display = "grid";
    audioPlayer.pause();
  });

  audioPlayer.addEventListener("timeupdate", () => {
    const percent = (audioPlayer.currentTime / audioPlayer.duration) * 100;

    progressBar.value = percent;

    const seconds = Math.ceil(audioPlayer.currentTime);

    currDuration.textContent = formatSeconds(seconds);
    finalDuration.textContent = formatSeconds(Math.ceil(audioPlayer.duration));
  });

  progressBar.addEventListener("input", (e) => {
    const seconds = (e.target.value / 100) * audioPlayer.duration;
    currDuration.textContent = formatSeconds(Math.ceil(seconds));

    audioPlayer.currentTime = seconds;
  });

  stopButton.addEventListener("click", () => {
    audioPlayer.pause();
    audioPlayerContainer.style.display = "none";
  })
}

const fetchSongsData = async () => {
  const response = await fetch(`${REST_URL}/app/song/${ARTIST_ID}?subscriber_id=${USER_ID}`);

  if (response.ok) {
    const { data } = await response.json();
    songsData = data;
    if (songsData.length === 0) {
      errorParagraph.textContent = "This artist doesn't have any songs yet!";
      errorParagraph.style.display = "block";
      songsTable.style.display = "none";
    }
  } else {
    if (response.status === 401) {
      errorParagraph.textContent =
        "You are not authorized to view this page's contents!";
      errorParagraph.style.display = "block";
      songsTable.style.display = "none";
    }
  }
};

const generateArtistDetailPage = async () => {
  console.log("This is called!");
  await fetchSongsData();

  if (songsData.length > 0) {
    songsData.forEach((song, idx) => {
      const onClick = async () => {
        const response = await fetch(`${REST_URL}/app/song/listen/${song.id}?subscriber_id=${USER_ID}`);

        if (response.ok) {
          const data = await response.blob();
          const filePath = URL.createObjectURL(data);

          audioPlayerContainer.style.display = "block";

          audioSource.src = filePath;
          audioPlayer.load();
          audioPlayer.play();

          pauseButton.style.display = "grid";
          playButton.style.display = "none";

          audioTitle.textContent = song.title;
        }
      };

      let tableRowElement = document.createElement("tr");
      tableRowElement.innerHTML = `
        <td><p>${idx + 1}</p></td>
        <td><p>${song.title}</p></td>
        <td><p>${formatSeconds(song.duration)}</p></td>
      `;

      let lastTableData = document.createElement("td");

      let tablePlayButton = document.createElement("button");
      tablePlayButton.addEventListener("click", async () => {
        await onClick();
      });
      tablePlayButton.textContent = "Play";

      lastTableData.appendChild(tablePlayButton);

      tableRowElement.appendChild(lastTableData);

      songsTable.appendChild(tableRowElement);
    });
  }
};

// Generate artist detail apge
generateArtistDetailPage();
