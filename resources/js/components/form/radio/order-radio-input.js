module.exports = (() => {
    const showDateTimeDelivery = (e) => {
        const deliveryAdd = document.querySelector('.date-time-delivery');
        if (e.classList.contains('delivery-type__express')) {
            deliveryAdd.removeAttribute("hidden");
        } else {
            deliveryAdd.setAttribute("hidden", "hidden");
        }
    }
    const handleClick = (e, list) => {
        list.forEach(node => {
            node.classList.remove('active');
            node.querySelector('input[type=radio]').checked = false;
        });
        e.currentTarget.classList.add('active');
        e.currentTarget.querySelector('input[type=radio]').checked = true;
        showDateTimeDelivery(e.currentTarget);
    }
    const payments = document.querySelectorAll('.payment-type > div');
    const delivery = document.querySelectorAll('.delivery-type > div');


    if (payments && delivery) {
        payments.forEach((item) => {
            item.addEventListener('click', (e) => {
                handleClick(e, payments);
            });
        });
        delivery.forEach((item) => {
            item.addEventListener('click', (e) => {
                handleClick(e, delivery);
            });
        });
    }
})();
