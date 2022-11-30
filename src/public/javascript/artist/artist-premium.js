// Fetch data from backend
let artistData = [];
let subsData = [];
let subsMap = new Map();
let errorParagraph = document.querySelector(".error-text");
let artistTable = document.querySelector(".artist-table");

const fetchArtistData = async () => {
  const response = await fetch(`${REST_URL}/user?page=1&pageSize=10`);

  if (response.ok) {
    const { data } = await response.json();
    artistData = data;
    if (artistData.length === 0) {
      errorParagraph.textContent = "This artist doesn't have any songs yet!";
      errorParagraph.style.display = "block";
      artistTable.style.display = "none";
    }
  } else {
    if (response.status === 401) {
      errorParagraph.textContent =
        "You are not authorized to view this page's contents!";
      errorParagraph.style.display = "block";
      artistTable.style.display = "none";
    }
  }
};

const fetchSubsData = async () => {
    const response = await fetch(`/public/subs/index?csrf_token=${CSRF_TOKEN}`);
    if (response.ok) {
        const { data } = await response.json();
        subsMap = data.reduce(function(map, obj) {
          map[obj.creator_id] = {name: obj.creator_name, status: obj.status};
          return map;
        }, {});
    } else {
        if (response.status === 401) {
            errorParagraph.textContent =
              "You are not authorized to view this page's contents!";
            errorParagraph.style.display = "block";
            artistTable.style.display = "none";
        }
    }
};

const generateArtistPremiumPage = async () => {
    await fetchArtistData();
    await fetchSubsData();
    if (artistData.length > 0) {
        artistData.forEach((artist, idx) => {
        let tableRowElement = document.createElement("tr");
            tableRowElement.innerHTML = `
            <td><p>${idx + 1}</p></td>
            <td><p>${artist.name}</p></td>`;
        let lastTableData = document.createElement("td");
        if (subsMap[artist.userID] === undefined) {
          let tableSubscribeButton = document.createElement("button");
          // tableSubscribeButton.addEventListener("click", async () => {
          //   await onCreateRequest();
          // });
          tableSubscribeButton.textContent = "Subscribe";
          lastTableData.appendChild(tableSubscribeButton);
          tableRowElement.appendChild(lastTableData);
        }
        else if (subsMap[artist.userID].status === "PENDING") {
          tableRowElement.innerHTML += `<td><p>Pending Subscription. Wait for Approval!</p></td>`;
        }
        else if (subsMap[artist.userID].status === "REJECTED") {
          tableRowElement.innerHTML += `<td><p>Sorry Subscription Rejected</p></td>`;
        }
        else {
          let tableDetailButton = document.createElement("button");
          tableDetailButton.addEventListener("click", async () => {
            location.href = `/public/artist/detail/${artist.userID}`;
          });
          tableDetailButton.textContent = "Detail";
          lastTableData.appendChild(tableDetailButton);
          tableRowElement.appendChild(lastTableData);
        }
        artistTable.appendChild(tableRowElement);
        });
    }
};

generateArtistPremiumPage();