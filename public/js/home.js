const offers = document.querySelectorAll(".offer-list-item");

function goToOffer() {
    const id = this.getAttribute("id");
    window.location.href = '../offer?offerId=' + id;
}

offers.forEach(button => button.addEventListener("click", goToOffer));