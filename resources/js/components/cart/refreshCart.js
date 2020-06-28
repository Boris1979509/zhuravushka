window.exports = refreshCart = (price, total, badgeCartCount, cart = null) => {
    if (cart) {
        cart.querySelector('.cart__sum-price').firstChild.data = `${price} `;
    }
    const CartTotalPrice = document.querySelector('.cart-total-wrap__total-price');
    if (CartTotalPrice) {
        CartTotalPrice.firstChild.data = `${total} `;
    }

    if (undefined === total) {
        document.querySelector('.cart__icon').classList.remove('active');
        document.querySelector('.sub-header__label.cart-total-sum').innerHTML = 'Корзина';
        document.getElementById('cart-qty').innerHTML = '0';
    } else {
        document.querySelector('.cart__icon').classList.add('active');
        document.querySelector('.sub-header__label.cart-total-sum').innerHTML = `${total} <span class="rub">₽</span>`;
        document.getElementById('cart-qty').innerHTML = badgeCartCount;
    }
}
