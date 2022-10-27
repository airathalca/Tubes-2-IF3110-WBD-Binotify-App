const formElement = document.querySelector(".album-form");
const titleInput = document.querySelector("#title");
// const artistInput = document.querySelector("#artist");
const dateInput = document.querySelector("#date");
const genreInput = document.querySelector("#genre");
const coverInput = document.querySelector("#cover");

formElement.addEventListener("submit", (e) => {
    if (!titleInput.value) {
        e.preventDefault();
        document.querySelector("#title-alert").className = "alert-show";
    } else {
        document.querySelector("#title-alert").className = "alert-hide";
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

coverInput.addEventListener("change", (e) => {
    const file = coverInput.files[0];
    const reader = new FileReader();
    
    if (file) {
        reader.readAsDataURL(file);
    }

    reader.addEventListener("load", () => {
        document.querySelector(".album-cover").src = reader.result;
    })
});