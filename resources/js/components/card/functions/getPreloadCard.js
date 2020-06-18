/**
 *
 * @param item
 */
getPreloadCard = (item) => {
    if (!item) return;
    const preloadElement = document.createElement("div");
    preloadElement.classList.add('lds-dual-ring');
    const parentDiv = item.parentNode;
    parentDiv.insertBefore(preloadElement, item);
    setTimeout(() => {
        preloadElement.remove();
    }, 600);
}

window.exports = getPreloadCard;
