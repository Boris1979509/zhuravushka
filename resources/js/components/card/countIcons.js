window.exports = countIcons = (data, className) => {
    const count = document.getElementById(`${className}-qty`);
    const countParentActive = count.closest('.icon');
    if (data === 0) {
        countParentActive.classList.remove('active');
    } else {
        countParentActive.classList.add('active');
    }
    count.innerHTML = data;
}
