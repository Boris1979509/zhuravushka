module.exports = (() => {
    const catalogSubsection = document.querySelector('.catalog__subsection');
    if (!catalogSubsection) return;
    const catalogAttributes = catalogSubsection.querySelectorAll('.catalog__attributes-title');

    catalogAttributes.forEach((item) => {
        item.addEventListener('click', (e) => {
            item.classList.toggle('active');
            const contentValues = item.nextElementSibling;
            contentValues.toggleAttribute('hidden');
        });
    });


    const checkboxes = catalogSubsection.querySelectorAll('input[type="checkbox"]');
    console.log(checkboxes);
    checkboxes.forEach((item) => {
        item.addEventListener('change', (event) => {
            if (event.target.checked) {
                const el = event.target.closest('.form-input');

                const span = document.createElement('span');
                span.setAttribute('class', 'filter-label');
                span.innerHTML = `<a href="${event.preventDefault()}${
                    document.querySelector('.form').submit()}">Показать</a>`;
                setTimeout(() => {
                    el.appendChild(span);
                }, 500);
                setTimeout(() => {
                    //el.classList.remove('filter-label');
                }, 5000);

            }
        });
    });


})();
