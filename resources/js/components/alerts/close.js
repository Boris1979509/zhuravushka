module.exports = ((close) => {
    if (!close) return;
    close.addEventListener('click', () => {
        close.closest('.alert').remove();
    });
})(document.querySelector('.alert-info__icon-close'));
