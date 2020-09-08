module.exports = (() => {
    const catalogAttributes = document.querySelectorAll('.catalog__attributes-title');

    if (!catalogAttributes) return;
    catalogAttributes.forEach((item) => {
        item.addEventListener('click', (e) => {
            item.classList.toggle('active');
            const contentValues = item.nextElementSibling;
            contentValues.toggleAttribute('hidden');
        });
    });
})();
