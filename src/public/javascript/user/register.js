const usernameInput = document.querySelector("#username");
const emailInput = document.querySelector("#email");
const passwordInput = document.querySelector("#password");
const passwordConfirmedInput = document.querySelector("#confirm-password");
const registrationForm = document.querySelector(".registration-form");

usernameInput &&
    usernameInput.addEventListener(
        "keyup",
        debounce(() => {
            const usernameAlert = document.querySelector("#username-alert");
            const username = usernameInput.value;

            const xhr = new XMLHttpRequest();
            xhr.open(
                "GET",
                `/public/user/username?username=${username}&csrf_token=${CSRF_TOKEN}`
            );

            xhr.send();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (this.status !== 200) {
                        console.log(username);
                        usernameAlert.className = "alert-hide";
                    } else {
                        console.log(username);
                        usernameAlert.className = "alert-show";
                    }
                }
            };
        }, DEBOUNCE_TIMEOUT)
    );

emailInput &&
    emailInput.addEventListener(
        "keyup",
        debounce(() => {
            const emailAlert = document.querySelector("#email-alert");
            const email = emailInput.value;

            const xhr = new XMLHttpRequest();
            xhr.open(
                "GET",
                `/public/user/email?email=${email}&csrf_token=${CSRF_TOKEN}`
            );

            xhr.send();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (this.status !== 200) {
                        console.log(email);
                        emailAlert.className = "alert-hide";
                    } else {
                        console.log(email);
                        emailAlert.className = "alert-show";
                    }
                }
            };
        }, DEBOUNCE_TIMEOUT)
    );

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
