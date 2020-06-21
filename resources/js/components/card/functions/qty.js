window.exports = getQuantity = (e, input) => {
    // Quantity items products
    const isNumber = (val) => {
        val = parseInt(val);
        return ((typeof val === "number") && (!isNaN(val)) && (val !== 0)) ? val : 1;
    }

    ((e, input) => {
        const formAction = input.closest('form').action;
        if (e.classList.contains("product-qty__plus")) {
            getPreloadCard(input);
            input.value = isNumber(input.value) + 1;
            addCart(formAction, input.value); // add to cart axios
        } else if (e.classList.contains("product-qty__minus")) {
            if (input.value > 1) {
                input.value = isNumber(input.value) - 1;
                addCart(formAction, input.value); // add to cart axios
            } else {
                input.value = isNumber(input.value);
                addCart(formAction, input.value); // add to cart axios
            }
            getPreloadCard(input);
        }
        input.addEventListener("input", function (e) {
            input.value = isNumber(input.value);
            addCart(formAction, input.value); // add to cart axios
            getPreloadCard(input);
        });
    })(e, input);
}
