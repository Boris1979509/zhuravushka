addActiveIconColor = (elem) => {
    const hasClass = (element, cls) => {
        return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
    }
    if (!hasClass(elem, 'active')) {
        elem.classList.add('active');
    }
}
window.exports = addActiveIconColor;
