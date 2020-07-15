window.exports = validator = (form, errors) => {
    if (!form) return;
    const errorMessage = document.querySelectorAll('.invalid-feedback');
    errorMessage.forEach((element) => {
        element.remove();
    });
    Array.from(form.elements, (el) => {
        if (errors[el['name']]) {
            const errorItem = errors[el['name']][0];
            el.insertAdjacentHTML('afterend', `<div class="invalid-feedback">${errorItem}</div>`);
        }
    });
}
