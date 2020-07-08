module.exports = (() => {
    const brandTitle = document.querySelector('.catalog__brand-title');

    if (!brandTitle) return;
    brandTitle.addEventListener('click', (e) => {
        const brandsContainer = document.querySelector('.catalog__brand__wrapper');
        brandsContainer.toggleAttribute('hidden');
    });
})();
