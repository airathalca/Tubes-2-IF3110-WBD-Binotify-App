const prevButton = document.querySelector("#prev-page");
const nextButton = document.querySelector("#next-page");
const usersList = document.querySelector(".users-list");
const pageNumber = document.querySelector("#page-number");

let currentPage = 1;

prevButton &&
    prevButton.addEventListener("click", async () => {
        if (currentPage === 1) {
            /* Tidak bisa kembali */
            return;
        }

        currentPage -= 1;

        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/public/user/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}`
        );

        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    const data = JSON.parse(this.responseText);
                    updateData(data);
                } else {
                    alert("An error occured, please try again!");
                }
            }
        };
    });

nextButton &&
    nextButton.addEventListener("click", async () => {
        if (currentPage === PAGES) {
            /* Tidak bisa next */
            return;
        }

        currentPage += 1;

        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/public/user/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}`
        );

        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    const data = JSON.parse(this.responseText);
                    updateData(data);
                } else {
                    alert("An error occured, please try again!");
                }
            }
        };
    });

const updateData = (data) => {
    let generatedHTML = "";
    data.users.map((user) => {
        generatedHTML += `
            <div class="single-user">
                <p>Email: ${user.email}</p>
                <p>Username: ${user.username}</p>
                ${
                    user.is_admin === "1"
                        ? "<p>Type: Admin</p>"
                        : "<p>Type: User</p>"
                }
            </div>
            `;
    });
    usersList.innerHTML = generatedHTML;
    pageNumber.innerHTML = currentPage;

    if (currentPage === 1) {
        prevButton.disabled = true;
    } else {
        prevButton.disabled = false;
    }

    if (currentPage === PAGES) {
        nextButton.disabled = true;
    } else {
        nextButton.disabled = false;
    }
};
