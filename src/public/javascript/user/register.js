const usernameInput = document.querySelector("#username");
const emailInput = document.querySelector("#email");
const passwordInput = document.querySelector("#password");
const passwordConfirmedInput = document.querySelector("#confirm-password");
const registrationForm = document.querySelector(".registration-form");

usernameInput &&
    usernameInput.addEventListener("keyup", async (e) => {
        const username = usernameInput.value;
    });

registrationForm &&
    registrationForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const username = usernameInput.value;
        const email = emailInput.value;
        const password = passwordInput.value;
        const passwordConfirmed = passwordConfirmedInput.value;

        if (!username || !email || !password || !passwordConfirmed) {
            window.alert(
                "Please fill out the form properly before submitting!"
            );
        }

        if (password !== passwordConfirmed) {
            window.alert("Password doesn't match confirmed password!");
        }

        const xhr = new XMLHttpRequest();

        xhr.open("POST", "/public/user/register");

        const formData = new FormData();
        formData.append("email", email);
        formData.append("username", username);
        formData.append("password", password);
        formData.append("csrf_token", CSRF_TOKEN);

        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const data = JSON.parse(xhr.responseText);
                location.replace(data.redirect_url);
            }
        };
    });
