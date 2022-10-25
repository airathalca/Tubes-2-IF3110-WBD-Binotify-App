const registrationForm = document.querySelector(".registration-form");
const usernameInput = document.querySelector("#username");
const emailInput = document.querySelector("#email");
const passwordInput = document.querySelector("#password");
const passwordConfirmedInput = document.querySelector("#confirm_password");

registrationForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const username = usernameInput.value;
    const email = emailInput.value;
    const password = passwordInput.value;
    const passwordConfirmed = passwordConfirmedInput.value;

    if (username === "") {
        alert("Username is empty!");
        return;
    }

    if (email === "") {
        alert("Email is empty!");
        return;
    }

    if (password === "") {
        alert("Password is empty!");
        return;
    }

    if (passwordConfirmed === "") {
        alert("Confirmed password is empty!");
        return;
    }

    if (password !== passwordConfirmed) {
        alert("Password is different from confirmed password!");
        return;
    }

    const xhr = new XMLHttpRequest();

    xhr.open("POST", "/public/user/register");
    xhr.send(
        `username=${username}&email=${email}&password=${password}&csrf_token=${CSRF_TOKEN}`
    );

    xhr.onreadystatechange = () => {
        if (this.readyState === XMLHttpRequest.DONE) {
            const data = JSON.parse(this.responseText);
            location.replace(data.redirect_url);
        }
    };
});
