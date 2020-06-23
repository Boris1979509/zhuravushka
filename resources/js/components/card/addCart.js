window.exports = addCart = (action, data, callback) => {
    callback = callback || ((data) => {
    });
    Axios.post(action, data).then((response) => {
        callback(response.data);
    }).catch(function (error) {
        console.log(error);
    });
};
