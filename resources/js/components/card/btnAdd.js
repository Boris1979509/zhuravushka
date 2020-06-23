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
                    addCart(item.action, {inc: "++"}, (data) => {
                        const cartCount = data.cartCount;
                        document.querySelector('.cart__qty').innerHTML = cartCount;
                    }); // add to cart axios

                })
            }
        });
    });
})();
