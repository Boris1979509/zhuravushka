module.exports = ((verifyForm) => {
    if (!verifyForm) return;
    const confirm = verifyForm.querySelector('#verify'); // Block
    const btn = verifyForm.button;
    const time = 60;

    /**
     * Input confirm token
     */
    const getVerifyInput = () => {
        const input = confirm.querySelector('input[name="verifyToken"]');
        if (input) {
            const array = [];
            input.addEventListener('input', (e) => {
                if (e.data) {
                    array.push(e.data);
                }
                if (array.length === 4) {
                    const tokenClient = array.join('');
                    console.log(tokenClient);
                }
            });
        }
    }
    /**
     * Send data
     */
    const dataSend = () => {
        const data = {
            phone: verifyForm.phone.value,
            _token: verifyForm._token.value
        }
        xmlHttpRequest(verifyForm.action, data, (data) => {
            if (data.errors) {
                validator(verifyForm, data.errors);
            } else {
                if (data.view) {
                    confirm.innerHTML = data.view;
                    timer(time);
                    getVerifyInput();
                }
            }
        });
    }

    verifyForm.addEventListener('submit', (e) => {
        e.preventDefault();
        dataSend();
    });

    /**
     * Start timer
     * @param t
     */
    const timer = (t) => {
        const timerShow = document.querySelector('.verify-block');

        const timer = setInterval(function () {
            if (t <= 0) {
                clearInterval(timer);
                const el = `<span class="code-confirm">Отправить еще раз</span>`;
                timerShow.innerHTML = el;
            } else {
                const strTimer = `<span class="confirm-timer">Повторная отправка будет доступна через ${t} сек.</span>`;
                timerShow.innerHTML = strTimer;
            }
            --t;
        }, 1000)
    }
    ((element) => {
        if (!element) return;
        element.addEventListener('click', () => {
            dataSend();
        });
    })(verifyForm.querySelector('.code-confirm'));

})(document.querySelector('.phone-verify__form-request'));
