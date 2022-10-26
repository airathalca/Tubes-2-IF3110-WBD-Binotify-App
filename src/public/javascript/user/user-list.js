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

        const response = await fetch(
            `/public/user/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}`
        );
        const data = await response.json();

        updateData(data);
    });

nextButton &&
    nextButton.addEventListener("click", async () => {
        if (currentPage === pages) {
            /* Tidak bisa next */
            return;
        }

        currentPage += 1;

        const response = await fetch(
            `/public/user/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}`
        );
        const data = await response.json();
        updateData(data);
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

    if (currentPage === pages) {
        nextButton.disabled = true;
    } else {
        nextButton.disabled = false;
    }
};
