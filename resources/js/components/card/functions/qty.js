window.exports = getQuantity = (e, input) => {
    // Quantity items products
    const isNumber = (val) => {
        val = parseInt(val);
        return ((typeof val === "number") && (!isNaN(val)) && (val !== 0)) ? val : 1;
    }

    ((e, input) => {
        const form = input.closest('form');
        if (e.classList.contains("product-qty__plus")) {
            getPreloadCard(input);
            input.value = isNumber(input.value) + 1; // add to cart axios
            addCart(form.action, {inc: "++"}, (data) => {
                console.log(data.message);
            });
        } else if (e.classList.contains("product-qty__minus")) {

            if (input.value > 1) {
                getPreloadCard(input);
                input.value = isNumber(input.value) - 1; // add to cart axios
                addCart(form.action, {inc: "--"}, (data) => {
                    console.log(data.message);
                });
            } else {
                form.querySelector('button.btn-add').classList.remove('btn-hide');
            }
        }
        input.addEventListener("input", function (e) {
            input.value = isNumber(input.value);
            addCart(form.action, input.value); // add to cart axios
            getPreloadCard(input);
        });
    })(e, input);
}
