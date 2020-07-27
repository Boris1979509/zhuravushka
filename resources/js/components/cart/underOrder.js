window.exports = (underOrder = (data, form) => {
    const qtyGoods = form.closest('.count').nextElementSibling;
    const underOrder = qtyGoods.closest('.cart__count').nextElementSibling;
    if (data) {
        const html = `<p class="qty-goods__balance">${data.unit_pricing_base_measure} в наличии</p>
                    <p class="qty-goods__order">+ ${data.under_order} под заказ</p></div>`;
        const htmlOrder = `<p class="order">+ ${data.under_order} x ${data.price}&nbsp;
                        <span class="rub">₽</span></p>`;
        qtyGoods.innerHTML = html;
        underOrder.querySelector('.under-order').innerHTML = htmlOrder;
        document.querySelector('.primary-info').removeAttribute('hidden');
    } else {
        document.querySelector('.primary-info').setAttribute('hidden', 'hidden');
        qtyGoods.innerHTML = '';
        underOrder.querySelector('.under-order').innerHTML = '';
    }
});
