const openModalButtons = document.querySelectorAll("[data-modal-target]");
const overlay = document.getElementById("overlay");

openModalButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const modal = document.querySelector(button.dataset.modalTarget);
        openModal(modal);
    });
});

function openModal(modal) {
    if (modal === null) {return;}
    modal.classList.add("active");
    overlay.classList.add("active");
    history.pushState(null, null, "popup.html");
}

window.addEventListener("popstate", (e) => {
    console.log(e);
});