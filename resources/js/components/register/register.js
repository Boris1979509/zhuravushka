module.exports = ((register) => {
    if (!register) return;
    const message = document.querySelector('.message');

    function clearAllFormInputs() {
        const form = document.querySelectorAll('form');
        form.forEach((item) => {
            item.reset();
        })
    }

    register.addEventListener('submit', function (e) {
        e.preventDefault();
        const data = {
            name: register.name.value,
            last_name: register.last_name.value,
            middle_name: register.middle_name.value,
            email: register.email.value,
            password: register.password.value,
            password_confirmation: register.password_confirmation.value,
            delivery_place: register.address.value,
            _token: register._token.value
        }
        xmlHttpRequest(register.action, data, (data) => {
            if (validator(register, data)) {
                message.innerHTML = data.success || data.error;
                window.scrollTo({top: 0, behavior: 'smooth'});
                if (data.success) {
                    const loginContainer = document.querySelector('.sub-header__login');
                    loginContainer.removeAttribute('hidden');
                    clearAllFormInputs();

                }
                close();
            }
        });
    });
})(document.querySelector('#register-form'));
