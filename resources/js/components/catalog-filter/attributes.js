module.exports = (() => {
    const catalogSubsection = document.querySelector('.catalog__subsection');
    if (!catalogSubsection) return;
    const catalogAttributes = catalogSubsection.querySelectorAll('.catalog__attributes-title');

    catalogAttributes.forEach((item) => {
        item.addEventListener('click', () => {
            item.classList.toggle('active');
            const contentValues = item.nextElementSibling;
            contentValues.toggleAttribute('hidden');
        });
    });

    const checkboxes = catalogSubsection.querySelectorAll('input[type="checkbox"]');
    const form = catalogSubsection.querySelector('form');

    /* Send show filter */
    function show_filter() {
        form.submit();
    }

    checkboxes.forEach((item) => {
        item.addEventListener('change', (event) => {
            if (event.target.checked) {
                const el = event.target.closest('.form-input');
                const a = document.createElement('a');
                a.setAttribute('class', 'filter-label');
                a.setAttribute('href', '#');
                a.innerHTML = 'Показать';
                setTimeout(() => {
                    el.appendChild(a);
                    a.addEventListener('click', show_filter);
                }, 500);
                setTimeout(() => {
                    a.remove();
                }, 5000);
            }
        });
    });

})();
