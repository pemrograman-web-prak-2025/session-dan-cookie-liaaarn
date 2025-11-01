document.addEventListener("DOMContentLoaded", () => {
    const openBtn = document.getElementById("openAddModal");
    const closeBtn = document.getElementById("closeAddModal");
    const modal = document.getElementById("addModal");

    openBtn.addEventListener("click", () => (modal.style.display = "flex"));
    closeBtn.addEventListener("click", () => (modal.style.display = "none"));
});
