const searchInput = document.querySelector("#search");
const filterInput = document.querySelector("#filter");
const sortInput = document.querySelector("#sort");

const prevButton = document.querySelector("#previous");
const nextButton = document.querySelector("#next");
const buttonSearch = document.querySelector(".search-form");
const pageNumber = document.querySelector("#page-number");

const pageText = document.querySelector("#pagination-text");
const songsResult = document.querySelector(".songs-result");

let currentPage = 1;
prevButton.addEventListener('click', async () => {
    if (currentPage === 1) {
        return;
    }
    currentPage -= 1;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/public/song/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}&q=${searchInput.value}&filter=${filterInput.value}&sort=${sortInput.value}`);

    xhr.send();

    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            data = JSON.parse(xhr.responseText);
            updateData(data);
        }
    }
})

document.querySelector("#next").addEventListener('click', async () => {
    if (currentPage === pages) {
        return;
    }
    currentPage += 1;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/public/song/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}&q=${searchInput.value}&filter=${filterInput.value}&sort=${sortInput.value}`);

    xhr.send();

    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            data = JSON.parse(xhr.responseText);
            updateData(data);
        }
    }
})

// buttonSearch.addEventListener('submit', async (e) => {
//     currentPage = 1;
//     e.preventDefault();
//     const xhr = new XMLHttpRequest();
//     xhr.open("GET", `/public/song/fetch/1?csrf_token=${CSRF_TOKEN}&q=${searchInput.value}&filter=${filterInput.value}&sort=${sortInput.value}`);

//     xhr.send();

//     xhr.onreadystatechange = () => {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             data = JSON.parse(xhr.responseText);
//             console.log(data);
//             newData(data);
//         }
//     }
// })

const updateData = (data) => {
    let newHTML = '';
    data.songs.map(song => {
        newHTML += `
        <a href="/public/song/detail/${song.song_id}" class="single-song">
            <img src="${STORAGE_URL}/images/7316a521430430e30f0b9f33fc8ed46b.png" alt="${song.judul}">
            <header class="song-header">
                <p class="title">${song.judul}</p>
                <p>${song.penyanyi}</p>
            </header>
            <div class="song-dategenre">
                <p>${song.tanggal_terbit.substring(0,4)}</p>
                <p>${song.genre}</p>
            </div>
        </a>
        `;
    })
    songsResult.innerHTML = newHTML;
    pageNumber.innerHTML = currentPage;
    if (currentPage == 1) {
        prevButton.disabled = true;
    } else {
        prevButton.disabled = false;
    }

    if (currentPage == pages) {
        nextButton.disabled = true;
    } else {
        nextButton.disabled = false;
    }
}

// const newData = (data) => {
//     pages = data.pages;
//     console.log(pages);
//     let newHTML = '';
//     if (pages === 0) {
//         newHTML += `
//         <p class="no-result">
//             Your Search did not match any songs in our database!
//         </p>
//         `;
//         songsResult.innerHTML = newHTML;
//         pageText.innerHTML = `Page <span id="page-number">0</span> out of 0 pages`;
//         prevButton.disabled = true;
//         nextButton.disabled = true;
//     }
//     else {
//         currentPage = 1;
//         pageText.innerHTML = `Page <span id="page-number">1</span> out of ${data.pages} pages`;
//         updateData(data);
//     }
// }

