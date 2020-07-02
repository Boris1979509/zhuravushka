module.exports = (() => {
    const handleClick = (e, list) => {
        list.forEach(node => {
            node.classList.remove('active');
            node.querySelector('input[type=radio]').checked = false;
        });
        e.currentTarget.classList.add('active');
        e.currentTarget.querySelector('input[type=radio]').checked = true;
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
