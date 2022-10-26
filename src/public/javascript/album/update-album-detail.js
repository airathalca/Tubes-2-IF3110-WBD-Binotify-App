const formElement = document.querySelector(".album-form");
const titleInput = document.querySelector("#title");
const artistInput = document.querySelector("#artist");
const dateInput = document.querySelector("#date");
const genreInput = document.querySelector("#genre");

formElement.addEventListener("submit", (e) => {
    if (
        !titleInput.value ||
        !artistInput.value ||
        !dateInput.value ||
        !genreInput.value
    ) {
        e.preventDefault();
        window.alert("Please fill out the form properly before updating!");
    }
});

const deleteButton = document.querySelector("#delete-button");

deleteButton.addEventListener("click", () => {
    const xhr = new XMLHttpRequest();

    xhr.open("POST", `/public/album/delete/${album_id}`);

    const formData = new FormData();
    formData.append("old_path", image_path);
    formData.append("csrf_token", CSRF_TOKEN);

    xhr.send(formData);

    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            data = JSON.parse(this.responseText);
            location.replace(data.redirect_url);
        }
    };
});
