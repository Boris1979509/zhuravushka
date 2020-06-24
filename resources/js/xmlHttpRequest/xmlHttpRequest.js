window.exports = xmlHttpRequest = (action, dataForm, callback) => {
    callback = callback || ((data) => {
    });
    Axios.post(action, dataForm).then((response) => {
        callback(response.data);
    }).catch(function (error) {
        console.log(error);
    });
};
