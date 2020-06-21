window.exports = (btnAdd = () => {
    const forms = document.querySelectorAll("form.addCart");
    if (!forms) return;
    Array.from(forms, (item) => {
        const formElements = item.elements;
        Array.from(formElements, (el) => {
            if (el.nodeName === "BUTTON") {
                el.addEventListener("click", function (e) {
                    e.preventDefault();
                    el.classList.add('btn-hide');
                    addCart(item.action, item["qty"].value); // add to cart axios
                    getPreloadCard(el);
                })
            }
        });
    });
})();
