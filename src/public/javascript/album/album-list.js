console.log("Hello World!");

const prevButton = document.querySelector("#prev-page");
const nextButton = document.querySelector("#next-page")
const albumsList = document.querySelector(".albums-list");
const pageNumber = document.querySelector("#page-number");

if (prevButton) {
    console.log(pages);
    
    let currentPage = 1;
    
    prevButton.addEventListener('click', async () => {
        if (currentPage === 1) {
            /* Tidak bisa kembali */
            return;
        }

        currentPage -= 1;
    
        const response = await fetch(`/public/album/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}`);
        const data = await response.json();
        console.log(data);
        updateData(data);
    })
    
    nextButton.addEventListener('click', async () => {
        if (currentPage === pages) {
            /* Tidak bisa next */
            return;
        }

        currentPage += 1;

        const response = await fetch(`/public/album/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}`);
        const data = await response.json();
        updateData(data);
    })
    
    const updateData = (data) => {
        let generatedHTML = '';
        data.albums.map(album => {
            generatedHTML += `
            <a href="/public/album/detail/${album.album_id}" class="single-album">
                <img src="${STORAGE_URL}/images/${album.image_path}" alt="${album.judul}">
                <header class="album-header">
                    <p class="title">${album.judul}</p>
                    <p>${album.penyanyi}</p>
                </header>
                <div class="album-dategenre">
                    <p>${album.tanggal_terbit}</p>
                    <p>${album.genre}</p>
                </div>
            </a>
            `;
        })
        albumsList.innerHTML = generatedHTML;

        pageNumber.innerHTML = currentPage;

        if (currentPage == 1) {
            prevButton.disabled = true;
        } else {
            prevButton.disabled = false;
        }
        
        console.log(currentPage, pages);
        if (currentPage == pages) {
            nextButton.disabled = true;
        } else {
            nextButton.disabled = false;
        }
    }
}
