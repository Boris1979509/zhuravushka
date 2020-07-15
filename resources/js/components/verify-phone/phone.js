module.exports = ((verifyForm) => {
    if (!verifyForm) return;
    const verifyBlock = verifyForm.querySelector('.input-phone-confirm'); // Block
    const verifyInput = verifyForm.verifyToken; // Input


    verifyForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const data = {
            phone: verifyForm.phone.value,
            _token: verifyForm._token.value
        }
        xmlHttpRequest(verifyForm.action, data, (data) => {
            if (data.errors) {
                validator(verifyForm, data.errors);
            } else {
                console.log('success');
            }
        });
    });
})(document.querySelector('.phone-verify__form'));
