window.exports = (cartRemove = () => {
    const forms = document.querySelectorAll("form.del-form");
    if (!forms) return;
    Array.from(forms, (item) => {
        //const formElements = item.elements;
        item.addEventListener('submit', (e) => {
            e.preventDefault();
            xmlHttpRequest(item.action, {}, (data) => {
                item.closest('.cart__product').remove();

                refreshCart(data.cartItemTotalSum, data.cartTotalSum, data.cartCount);
                if (data.view)
                    //console.log(data.view);
                    document.querySelector('.flex-center').innerHTML = data.view;
            });
        })
    });
})();
