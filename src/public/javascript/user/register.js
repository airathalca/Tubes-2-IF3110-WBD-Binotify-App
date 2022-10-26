const usernameInput = document.querySelector("#username");
const emailInput = document.querySelector("#email");
const passwordInput = document.querySelector("#password");
const passwordConfirmedInput = document.querySelector("#confirm-password");
const registrationForm = document.querySelector(".registration-form");
const usernameAlert = document.querySelector("#username-alert");
const emailAlert = document.querySelector("#email-alert");
const passwordAlert = document.querySelector("#password-alert");
const passwordConfirmedAlert = document.querySelector(
    "#confirm-password-alert"
);

const usernameRegex = /^\w+$/;
const emailRegex =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
const passwordRegex = /^\w+$/;

let usernameValid = false;
let emailValid = false;
let passwordValid = false;
let passwordConfirmedValid = false;

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
                        usernameValid = false;
                    } else if (!usernameRegex.test(username)) {
                        usernameAlert.innerText = "Invalid username format!";
                        usernameAlert.className = "alert-show";
                        usernameValid = false;
                    } else {
                        usernameAlert.innerText = "";
                        usernameAlert.className = "alert-hide";
                        usernameValid = true;
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
                        emailValid = false;
                    } else if (!emailRegex.test(email)) {
                        emailAlert.innerText = "Invalid email format!";
                        emailAlert.className = "alert-show";
                        emailValid = false;
                    } else {
                        emailAlert.innerText = "";
                        emailAlert.className = "alert-hide";
                        emailValid = true;
                    }
                }
            };
        }, DEBOUNCE_TIMEOUT)
    );

passwordInput &&
    passwordInput.addEventListener(
        "keyup",
        debounce(() => {
            const password = passwordInput.value;
            const passwordConfirmed = passwordConfirmedInput.value;

            if (!passwordRegex.test(password)) {
                passwordAlert.innerText = "Invalid password format!";
                passwordAlert.className = "alert-show";
                passwordValid = false;
            } else {
                passwordAlert.innerText = "";
                passwordAlert.className = "alert-hide";
                passwordValid = true;
            }

            if (password !== passwordConfirmed) {
                passwordConfirmedAlert.innerText =
                    "Confirmed password doesn't match!";
                passwordConfirmedAlert.className = "alert-show";
                passwordConfirmedValid = false;
            } else {
                passwordConfirmedAlert.innerText = "";
                passwordConfirmedAlert.className = "alert-hide";
                passwordConfirmedValid = true;
            }
        }, DEBOUNCE_TIMEOUT)
    );

passwordConfirmedInput &&
    passwordConfirmedInput.addEventListener(
        "keyup",
        debounce(() => {
            const password = passwordInput.value;
            const passwordConfirmed = passwordConfirmedInput.value;

            if (password !== passwordConfirmed) {
                passwordConfirmedAlert.innerText =
                    "Confirmed password doesn't match!";
                passwordConfirmedAlert.className = "alert-show";
                passwordConfirmedValid = false;
            } else {
                passwordConfirmedAlert.innerText = "";
                passwordConfirmedAlert.className = "alert-hide";
                passwordConfirmedValid = true;
            }
        }, DEBOUNCE_TIMEOUT)
    );

registrationForm &&
    registrationForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const username = usernameInput.value;
        const email = emailInput.value;
        const password = passwordInput.value;

        if (
            !usernameValid ||
            !emailValid ||
            !passwordValid ||
            !passwordConfirmedValid
        ) {
            window.alert(
                "Please fill out the form properly before submitting!"
            );
            return;
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
