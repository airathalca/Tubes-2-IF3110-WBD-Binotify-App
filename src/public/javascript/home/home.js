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