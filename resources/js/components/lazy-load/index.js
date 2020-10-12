module.exports = ((LazyLoad) => {
    const callback_loaded = (element) => {
        const parent = element.closest('.card__body');
        const preload = parent.querySelector('.preload');

        setTimeout(() => {
            preload.classList.add('fade');
            preload.remove();
        }, 1000);
    }
    new LazyLoad({
        threshold: 0,
        elements_selector: '.lazy-load',
        callback_loading: callback_loaded
    });
});
