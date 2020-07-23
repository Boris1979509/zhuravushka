window.exports = addCardTitleHeight = () => {
    const title = document.querySelectorAll('.card__title');
    if (!title) return;
    const maxHeight = 50;
    title.forEach((item) => {
        if (item.clientHeight > maxHeight) {
            item.style = `height: 40px`;
            item.firstElementChild.classList.add('active');
        }
    });
}
