window.exports = addCart = (action, qty) => {
    Axios.post(action, {qty: qty}).then((resp) => {
        console.log(resp);
    }).catch(function (error) {
        console.log(error);
    });
};
