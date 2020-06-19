const btnQty = () => {

    const productQty = document.querySelectorAll('.card .product-qty');
    const cart = document.querySelector('.cart__icon');

    if (!productQty) return;
    Array.from(productQty, (item) => {
        const qtyInput = item.querySelector('.product-qty__input');
        item.addEventListener("click", (e) => {
            getQuantity(e.target, qtyInput);
            addActiveIconColor(cart);
        });
    });

};
window.exports = btnQty();
