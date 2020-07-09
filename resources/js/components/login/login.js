module.exports = ((login) => {
    if (!login) return;
    const loginContainer = document.querySelector('.sub-header__login');
    /**
     * @param event
     * @param elem
     * @param clickElem
     */
    const toggleShow = (event, elem, clickElem) => {
        if (!elem && clickElem) return;
        if (elem.contains(event) || clickElem.contains(event)) {
            return;
        }
        elem.setAttribute('hidden', 'hidden');
    }
    login.addEventListener('click', (e) => {
        loginContainer.toggleAttribute('hidden');
    });

    document.addEventListener('click', (event) => {
        toggleShow(event.target, loginContainer, login);
    });
})(document.querySelector('#login'));
