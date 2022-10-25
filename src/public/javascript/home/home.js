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

logOutButton.addEventListener('click', async (e) => {
    e.preventDefault();
    await fetch('/public/user/logout', {
        method: 'POST'
    });
    window.alert("Logged out!");
})