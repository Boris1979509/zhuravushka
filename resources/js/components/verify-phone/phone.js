module.exports = ((mainBlock) => {
    if (!mainBlock) return;
    /***************************************************/
    const requestBlock = mainBlock.querySelector('.request-block');
    const requestBlockBtn = requestBlock.querySelector("button#request-btn"); // btn request
    const requestPhoneInput = requestBlock.querySelector("input[name=phone]"); // input phone
    const verifyBlock = mainBlock.querySelector(".verify-block");

    const requestAction = '/phone';
    const verifyAction = '/verify';
    /**/
    let time = 60;
    let timer = null;
    const tokenLength = 4;
    /*********************************/
    /**
     * Message
     * @param message
     */
    const message = (message) => {
        verifyBlock.innerHTML = `<div class="invalid-feedback my">${message}</div>`;
    }
    /**
     * Clear timer
     */
    const clearTimer = () => {
        clearInterval(timer);
        requestBlockBtn.removeAttribute('hidden');
        requestPhoneInput.removeAttribute('readonly');
    }
    /**
     * Start timer
     * @param t
     */
    const startTimer = (t) => {
        const timerShow = verifyBlock.querySelector('.verify-block-timer');
        timer = setInterval(() => {
            if (t <= 0) {
                verifyBlock.innerHTML = '';
                clearTimer();
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
        const data = {
            tokenClient: tokenClient,
        }
        xmlHttpRequest(verifyAction, data, (data) => {
            /* VERIFY FALSE */
            if (!data.verified) {
                message(data.message);
            } else {
                verifyBlock.innerHTML = '';
                /* VERIFY TRUE */
                const nextForm = mainBlock.closest('.phone-verify').nextElementSibling;
                nextForm.scrollIntoView({behavior: 'smooth'});
                nextForm.querySelector('button[type=submit]')
                    .closest('.form-input')
                    .removeAttribute('hidden');
            }
            clearTimer();
        });
    }

    /**
     * Input confirm token
     */
    const getVerifyInput = () => {
        const verifyBlockInput = verifyBlock.querySelector('input[name=verifyToken]');
        verifyBlockInput.focus();
        if (verifyBlockInput) {
            const array = [];
            verifyBlockInput.addEventListener('input', (e) => {
                if (e.data) {
                    array.push(e.data);
                }
                if (array.length === tokenLength) {
                    const tokenClient = array.join('');
                    verify(tokenClient);
                }
            });
            verifyBlockInput.addEventListener('paste', (event) => {
                const tokenClient = (event.clipboardData || window.clipboardData).getData('text');
                verify(tokenClient);
            });
        }
    }
    /**
     * Send data
     */
    const dataSend = (data) => {
        if (!data) return;
        xmlHttpRequest(requestAction, data, (data) => {
            validator(requestBlock, data);
            if (data.hasOwnProperty('resultVerify')) {
                const attempts = data.resultVerify.attempts;
                if (attempts || !data.resultVerify.status) {
                    message(data.resultVerify.message);
                }
            }
            if (data.view && !data.resultVerify.attempts) {
                verifyBlock.innerHTML = data.view;
                startTimer(time);
                getVerifyInput();
                requestBlockBtn.setAttribute('hidden', 'hidden');
                requestPhoneInput.setAttribute('readonly', 'readonly');
            }
        });

    }

    /**
     * Send
     */
    requestBlockBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const data = {
            phone: requestPhoneInput.value,
        }
        dataSend(data);
    });


})(document.querySelector('.phone-verify'));
