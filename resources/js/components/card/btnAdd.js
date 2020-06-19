const btnAdd = () => {
    const buttons = document.querySelectorAll(".card .btn-add");
    if (!buttons) return;
    Array.from(buttons, (item) => {
        item.addEventListener("click", function (e) {
            item.classList.add('btn-hide');
            getQuantity(e.target, item);
            getPreloadCard(item);
        });
    });
};
window.exports = btnAdd();
