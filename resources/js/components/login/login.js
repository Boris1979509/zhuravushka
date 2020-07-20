module.exports = ((login) => {
    if (!login) return;
    const loginContainer = document.querySelector('.sub-header__login');
    const loginForm = document.getElementById("login-form");
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
    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const data = {
            phone: loginForm.phone.value,
            password: loginForm.password.value,
            _token: loginForm._token.value
        }
        xmlHttpRequest(loginForm.action, data, (data) => {
            if (validator(loginForm, data)) {
                window.location.href = '/cabinet';
            }
        });
    });
})(document.querySelector('#login'));
