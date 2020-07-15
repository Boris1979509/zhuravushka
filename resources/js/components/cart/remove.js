window.exports = (cartRemove = () => {
    const forms = document.querySelectorAll("form.del-form");
    if (!forms) return;
    Array.from(forms, (item) => {
        item.addEventListener('submit', (e) => {
            e.preventDefault();
            xmlHttpRequest(item.action, {}, (data) => {
                item.closest('.cart__product').remove();
                refreshCart(data.cartItemTotalSum, data.cartTotalSum, data.cartCount);
                if (data.view) {
                    document.querySelector('.flex-center').innerHTML = data.view;
                } else {
                    if (data.dataMsg.status === 'success') {
                        flash(data.dataMsg.message, data.dataMsg.status);
                    }
                }
            });
        })
    });
})();
