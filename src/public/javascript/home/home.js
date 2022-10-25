const toggleButton = document.querySelector("#toggle");
const navContainer = document.querySelector("#nav-container");
let isToggled = false;

toggleButton.addEventListener('click', () => {
    if (!isToggled) {
        /* Show navbar! */
        isToggled = true;
        toggleButton.className = "toggle-rotate";
        navContainer.className = "nav-container show";
    } else {
        isToggled = false;
        toggleButton.className = "toggle";
        navContainer.className = "nav-container";
    }
})

const logOutButton = document.querySelector("#log-out");

logOutButton && logOutButton.addEventListener('click', async (e) => {
    e.preventDefault();
    let data = {};

    const xhr = new XMLHttpRequest();

    xhr.open("POST", `/public/user/logout?csrf_token=${CSRF_TOKEN}`);
    xhr.send();

    xhr.onreadystatechange = function() {
        if (this.readyState === 4) {
            data = JSON.parse(this.responseText);
            location.replace(data.redirect_url);
        }
    }
})