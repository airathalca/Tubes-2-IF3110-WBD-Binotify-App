const usernameInput = document.querySelector("#username");
const emailInput = document.querySelector("#email");
const passwordInput = document.querySelector("#password");
const passwordConfirmedInput = document.querySelector("#confirm-password");
const registrationForm = document.querySelector(".registration-form");
const usernameAlert = document.querySelector("#username-alert");
const emailAlert = document.querySelector("#email-alert");

const usernameRegex = /^\w+$/g;
const emailRegex =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

usernameInput &&
    usernameInput.addEventListener(
        "keyup",
        debounce(() => {
            const username = usernameInput.value;

            const xhr = new XMLHttpRequest();
            xhr.open(
                "GET",
                `/public/user/username?username=${username}&csrf_token=${CSRF_TOKEN}`
            );

            xhr.send();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 200) {
                        usernameAlert.innerText = "Username already taken!";
                        usernameAlert.className = "alert-show";
                    } else if (!usernameRegex.test(username)) {
                        usernameAlert.innerText = "Invalid username format!";
                        usernameAlert.className = "alert-show";
                    } else {
                        usernameAlert.innerText = "";
                        usernameAlert.className = "alert-hide";
                    }
                }
            };
        }, DEBOUNCE_TIMEOUT)
    );

emailInput &&
    emailInput.addEventListener(
        "keyup",
        debounce(() => {
            const email = emailInput.value;

            const xhr = new XMLHttpRequest();
            xhr.open(
                "GET",
                `/public/user/email?email=${email}&csrf_token=${CSRF_TOKEN}`
            );

            xhr.send();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 200) {
                        emailAlert.innerText = "Email already registered!";
                        emailAlert.className = "alert-show";
                    } else if (!emailRegex.test(email)) {
                        emailAlert.innerText = "Invalid email format!";
                        emailAlert.className = "alert-show";
                    } else {
                        emailAlert.innerText = "";
                        emailAlert.className = "alert-hide";
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
                if (this.status === 201) {
                    const data = JSON.parse(xhr.responseText);
                    location.replace(data.redirect_url);
                } else {
                    // BISA DICEK KEMBALI DR SEMUA STATUS CODE YANG DIKIRIMKAN
                    alert("An error occured, please try again!");
                }
            }
        };
    });
