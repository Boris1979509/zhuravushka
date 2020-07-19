window.exports = validator = (form, data = null) => {
    if (!form) return;
    const errorMessage = form.querySelectorAll('.invalid-feedback');
    errorMessage.forEach((element) => {
        element.remove();
    });
    if (data.errors) {
        Array.from(form.elements, (el) => {
            if (data.errors[el['name']]) {
                const errorItem = data.errors[el['name']][0];
                el.insertAdjacentHTML('afterend', `<div class="invalid-feedback">${errorItem}</div>`);
            }
        });
        return false;
    }
    return true;
}
