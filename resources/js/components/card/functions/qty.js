window.exports = getQuantity = (e, input) => {
    // Quantity items products
    const isNumber = (val) => {
        val = parseInt(val);
        return ((typeof val === "number") && (!isNaN(val)) && (val !== 0)) ? val : 1;
    }
    /**
     *
     * @param cart
     * @param price
     * @param total
     */
    const replacePrice = (cart, price, total) => {
        if (!cart) return;
        cart.querySelector('.cart__sum-price').firstChild.data = `${price} `;
        document.querySelector('.cart-total-wrap__total-price')
            .firstChild.data = `${total} `;
        document.querySelector('.sub-header__label.cart-total-sum').firstChild.data = `${total} `;
    }

    ((e, input) => {
        const form = input.closest('form');
        const btn = form.querySelector('button.btn-add');
        const cart = form.closest('.cart__product');
        if (e.classList.contains("product-qty__plus")) {
            getPreloadCard(input);
            input.value = isNumber(input.value) + 1; // add to cart axios
            xmlHttpRequest(form.action, {inc: "++"}, (data) => {
                replacePrice(cart, data.cartItemTotalSum, data.cartTotalSum);
            });
        } else if (e.classList.contains("product-qty__minus")) {

            if (input.value > 1) {
                getPreloadCard(input);
                input.value = isNumber(input.value) - 1; // add to cart axios
                xmlHttpRequest(form.action, {inc: "--"}, (data) => {
                    replacePrice(cart, data.cartItemTotalSum, data.cartTotalSum);
                });
            } else {
                if (!btn)
                    return;
                btn.classList.remove('btn-hide');
            }
        }
        input.addEventListener("input", function (e) {
            input.value = isNumber(input.value);
            xmlHttpRequest(form.action, input.value, (data) => {

            }); // add to cart axios
            getPreloadCard(input);
        });
    })(e, input);
}
