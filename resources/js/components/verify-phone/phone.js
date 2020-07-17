module.exports = ((formRequest) => {
    if (!formRequest) return;
    const verifyBlock = formRequest.closest('.phone-verify').querySelector('.verify-block-form'); // Block
    const btn = formRequest.button;
    let time = 60;
    /**
     * Start timer
     * @param t
     */
    const timer = (t) => {
        const timerShow = document.querySelector('.verify-block-timer');
        const timer = setInterval(() => {
            if (t <= 0) {
                clearInterval(timer);
                timerShow.innerHTML = `<button type="submit" class="code-confirm">Отправить еще раз</button>`;
            } else {
                timerShow.innerHTML = `<span class="confirm-timer">Повторная отправка будет доступна через ${t} сек.</span>`;
            }
            --t;
        }, 1000)
    }
    const verify = (tokenClient) => {
        const formVerify = verifyBlock.querySelector('.form-verify-phone');
        const data = {
            tokenClient: tokenClient,
            _token: formVerify._token.value
        }
        xmlHttpRequest(formVerify.action, data, (data) => {
            if (!data.status) {
                timer(time = 0);
            }
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
                if (array.length === 4) {
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
            if (data.resultVerify.attempts !== undefined) {
                verifyBlock.remove();
            }
            if (data.view && !data.resultVerify.attempts) {
                verifyBlock.innerHTML = data.view;
                timer(time);
                getVerifyInput();
            }
        });

    }

    formRequest.addEventListener('submit', (e) => {
        e.preventDefault();
        dataSend();
    });


})(document.querySelector('.form-request-phone'));
