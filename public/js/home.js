
const offersContainer = document.getElementById("offers-container");


window.onload = (event) => {
    loadOffers();
};

function loadOffers() {
    fetch("/getOffersWithTags", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(function (response) {
        return response.json();
    }).then(function (offers) {
        offers.map(x => x.tags = JSON.parse(x.tags));
        offersContainer.innerHTML = "";
        offers.forEach(x => createOffer(x))
    });
}

function createOffer(offer) {
    const template = document.querySelector("#offer-template");
    const clone = template.content.cloneNode(true);
    const spanTitle = clone.querySelector(".offer-title");
    spanTitle.innerHTML = offer.title
    const spanCompany = clone.querySelector(".smaller-text");
    spanCompany.innerHTML = offer.company;

    const offerListItem = clone.querySelector(".offer-list-item");
    offerListItem.addEventListener("click", () => goToOffer(offer.id))

    const tagsContainer = clone.querySelector(".tags-home-container");
    createTags(tagsContainer, offer);
    offersContainer.appendChild(clone);
}

function createTags(tagsContainer, offer) {
    offer.tags.forEach(tag => {
        let div = document.createElement("div");
        div.className = "tag";
        div.innerHTML = tag;
        tagsContainer.appendChild(div);
    })

    let div = document.createElement("div");
    div.className = "tag";
    div.innerHTML = offer.localization;
    tagsContainer.appendChild(div);

    div = document.createElement("div");
    div.className = "tag";
    div.innerHTML = offer.salary + " PLN";
    tagsContainer.appendChild(div);
}

function goToOffer(id) {
    window.location.href = '../offer?offerId=' + id;
}
