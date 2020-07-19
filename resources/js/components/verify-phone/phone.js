module.exports = ((formRequest) => {
    if (!formRequest) return;
    /***************************************************/
    const verifyBlock = formRequest.closest('.phone-verify').querySelector('.verify-block-form'); // Block
    const requestBlock = formRequest.querySelector('.request-block'); // Block
    const btnRequest = formRequest.elements["number-btn"];
    const inputRequestPhone = formRequest.phone;
    let time = 60;
    let timer = null;
    const tokenLength = 4;
    /*********************************/
    /**
     * Message
     * @param message
     */
    const message = (message) => {
        requestBlock.insertAdjacentHTML("afterend", `<div class="invalid-feedback">${message}</div>`);
    }
    /**
     * Clear timer
     */
    const clearTimer = (timerShow) => {
        clearInterval(timer);
        verifyBlock.innerHTML = "";
        //timerShow.innerHTML = `<button type="submit" class="code-confirm">Отправить еще раз</button>`;
        btnRequest.removeAttribute('hidden');
        inputRequestPhone.removeAttribute('readonly');
    }
    /**
     * Start timer
     * @param t
     */
    const startTimer = (t) => {

        timer = setInterval(() => {
            const timerShow = document.querySelector('.verify-block-timer');
            if (t <= 0) {
                clearTimer(timerShow);
            } else {
                timerShow.innerHTML = `<span class="confirm-timer">Повторная отправка будет доступна через ${t} сек.</span>`;
            }
            --t;
        }, 1000)
    }
    /**
     * Verify
     * @param tokenClient
     */
    const verify = (tokenClient) => {
        const formVerify = verifyBlock.querySelector('.form-verify-phone');
        const timerShow = formVerify.querySelector('.verify-block-timer');
        const data = {
            tokenClient: tokenClient,
            _token: formVerify._token.value
        }
        xmlHttpRequest(formVerify.action, data, (data) => {
            formVerify.remove();
            /* If is verify code false */
            if (!data.verified) {
                message(data.message);
            } else {
                /* If is verify code true */
                const nextForm = formRequest.closest('.phone-verify').nextElementSibling;
                nextForm.scrollIntoView({behavior: 'smooth'});
                nextForm.querySelector('button[type=submit]')
                    .closest('.form-input')
                    .removeAttribute('hidden');
            }
            clearTimer(timerShow);
        });
    }

    /**
     * Input confirm token
     */
    const getVerifyInput = () => {
        const input = verifyBlock.querySelector('input[name="verifyToken"]');
        if (input) {
            const array = [];
            input.addEventListener('input', (e) => {
                if (e.data) {
                    array.push(e.data);
                }
                if (array.length === tokenLength) {
                    const tokenClient = array.join('');
                    verify(tokenClient);
                }
            });
            input.addEventListener('paste', (event) => {
                const tokenClient = (event.clipboardData || window.clipboardData).getData('text');
                verify(tokenClient);
            });
        }
    }
    /**
     * Send data
     */
    const dataSend = () => {
        const data = {
            phone: formRequest.phone.value,
            _token: formRequest._token.value
        }
        xmlHttpRequest(formRequest.action, data, (data) => {
            validator(formRequest, data);
            if (data.hasOwnProperty('resultVerify')) {
                const attempts = data.resultVerify.attempts;
                if (attempts) {
                    message(data.resultVerify.message);
                    verifyBlock.remove();
                }
            }
            if (data.view && !data.resultVerify.attempts) {
                verifyBlock.innerHTML = data.view;
                startTimer(time);
                getVerifyInput();
                btnRequest.setAttribute('hidden', 'hidden');
                inputRequestPhone.setAttribute('readonly', 'readonly');
            }

        });

    }

    formRequest.addEventListener('submit', (e) => {
        e.preventDefault();
        dataSend();
    });


})(document.querySelector('.form-request-phone'));
