getQuantity = (e, input) => {
    // Quantity items products
    const isNumber = (val) => {
        val = parseInt(val);
        return ((typeof val === "number") && (!isNaN(val)) && (val !== 0)) ? val : 1;
    }

    ((e, input) => {
        if (e.classList.contains("product-qty__plus")) {
            input.value = isNumber(input.value) + 1;
            getPreloadCard(input);
        } else if (e.classList.contains("product-qty__minus")) {
            if (input.value > 1) {
                input.value = isNumber(input.value) - 1;
            } else {
                input.value = isNumber(input.value);
            }
            getPreloadCard(input);
        }

        return false;
    })(e, input);
}
window.exports = getQuantity;
