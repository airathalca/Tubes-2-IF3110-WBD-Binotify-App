const formElement = document.querySelector('.form');
const titleInput = document.querySelector("#title");
const artistInput = document.querySelector("#artist");
const dateInput = document.querySelector("#date");
const genreInput = document.querySelector("#genre");
const coverInput = document.querySelector("#cover");
const audioInput = document.querySelector("#audio");

formElement.addEventListener('submit', (e) => {
    if (!titleInput.value) {
        e.preventDefault();
        document.querySelector("#title-alert").className = "alert-show";
    } else {
        document.querySelector("#title-alert").className = "alert-hide";
    }

    if (!artistInput.value) {
        e.preventDefault();
        document.querySelector("#artist-alert").className = "alert-show";
    } else {
        document.querySelector("#artist-alert").className = "alert-hide";
    }

    if (!dateInput.value) {
        e.preventDefault();
        document.querySelector("#date-alert").className = "alert-show";
    } else {
        document.querySelector("#date-alert").className = "alert-hide";
    }

    if (!genreInput.value) {
        e.preventDefault();
        document.querySelector("#genre-alert").className = "alert-show";
    } else {
        document.querySelector("#genre-alert").className = "alert-hide";
    }

    if (coverInput.files.length === 0) {
        e.preventDefault();
        document.querySelector("#cover-alert").className = "alert-show";
    } else {
        document.querySelector("#cover-alert").   className = "alert-hide";
    }

    if (audioInput.files.length === 0) {
        e.preventDefault();
        document.querySelector("#audio-alert").className = "alert-show";
    } else {
        document.querySelector("#audio-alert").   className = "alert-hide";
    }
});