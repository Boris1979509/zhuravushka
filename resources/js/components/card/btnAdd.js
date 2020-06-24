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
                    getPreloadCard(el);
                    xmlHttpRequest(item.action, {inc: "++"}, (data) => {
                        const cartCount = data.cartCount;
                        document.querySelector('.cart__qty').innerHTML = cartCount;
                        addActiveIconColor(document.querySelector('.cart__icon'));
                    }); // add to cart axios

                })
            } else {
                return null;
            }
        });
    });
})();
