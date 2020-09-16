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
    const show_filter = () => {
        form.submit();
    }
    /**
     *
     * @param element
     * @returns {string}
     */
    const position = (element) => {
        return (element.offsetTop - 10) + 'px';
    }

    checkboxes.forEach((item) => {
        item.addEventListener('change', (event) => {
            if (event.target.checked) {
                const element = event.target;
                /* create element */
                const a = document.createElement('a');
                a.setAttribute('class', 'filter-label');
                a.setAttribute('href', 'javascript:void()');
                a.innerHTML = 'Показать';
                setTimeout(() => {
                    catalogSubsection.appendChild(a).style.top = position(element.closest('.form-input'));
                    a.addEventListener('click', show_filter);
                }, 500);
                setTimeout(() => {
                    a.remove();
                }, 5000);
            }
        });
    });

})();
