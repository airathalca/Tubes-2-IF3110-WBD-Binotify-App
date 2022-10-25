const formElement = document.querySelector('.form');
const titleInput = document.querySelector("#title");
const artistInput = document.querySelector("#artist");
const dateInput = document.querySelector("#date");
const genreInput = document.querySelector("#genre");
const coverInput = document.querySelector("#cover");

formElement.addEventListener('submit', (e) => {
    if (!titleInput.value || !artistInput.value || !dateInput.value || !genreInput.value || coverInput.files.length === 0) {
        e.preventDefault();
        window.alert("Please fill out the form properly before submitting!");
    }
});