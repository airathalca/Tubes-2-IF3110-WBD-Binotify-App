const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");
const loginForm = document.querySelector(".login-form");

loginForm &&
    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const username = usernameInput.value;
        const password = passwordInput.value;

        if (!username || !password) {
            window.alert(
                "Please fill out the form properly before submitting!"
            );
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/public/user/login");

        const formData = new FormData();
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
