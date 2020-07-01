module.exports = ((input) => {
    if (!input)
        return;

    Array.from(input, (item) => {
        item.addEventListener('input', (e) => {
            e.currentTarget.setAttribute('data-empty', !e.currentTarget.value);
        });
    });
})(document.querySelectorAll('input'));
