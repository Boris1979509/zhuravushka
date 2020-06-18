const btnAdd = () => {
    const buttons = document.querySelectorAll(".card .btn-add");
    if (!buttons) return;
    Array.from(buttons, (item) => {
        item.addEventListener("click", function () {
            item.classList.add('btn-hide');
            getPreloadCard(item);
        });
    });
};
window.exports = btnAdd();
