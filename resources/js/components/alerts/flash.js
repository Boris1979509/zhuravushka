window.exports = flash = (message = null) => {
    const div = document.createElement('div');
    const closeBlock = document.createElement('div');
    const close = document.createElement('span');

    close.className = 'alert-info__close__icon-close';
    closeBlock.className = 'alert-info__close';
    closeBlock.append(close);

    div.className = 'alert alert-flash';
    div.innerHTML = `<p>${message}</p>`;
    div.appendChild(closeBlock);

    document.body.appendChild(div);

    setTimeout(() => {
        div.remove();
    }, 3000);

    close.addEventListener('click', () => {
        close.closest('.alert').remove();
    });
}
