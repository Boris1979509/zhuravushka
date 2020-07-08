module.exports = (() => {
    const close = document.querySelector('.alert-info__close__icon-close');
    if (!close) return;
    close.addEventListener('click', () => {
        close.closest('.alert').remove();
    });
})();
