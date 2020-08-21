module.exports = ((formSearch) => {
    if (!formSearch) return;
    const searchDropDown = document.querySelector('.search-dropdown');
    const resultBlock = document.querySelector('.search-result');
    const resultTitle = document.querySelector('.search-title');
    /**
     *
     * @param event
     * @param elem
     */
    const toggleShow = (event, elem) => {
        if (elem.contains(event)) {
            return;
        }
        elem.setAttribute('hidden', 'hidden');
    };

    /**
     *
     * @param wordToMatch
     * @param data
     * @returns {*}
     */
    function findMatches(wordToMatch, data) {
        return data.filter(item => {
            const regex = new RegExp(wordToMatch, 'gi');
            return item.title.match(regex) || item.title.match(regex);
        })
    }

    /**
     *
     * @param value
     * @param data
     */
    function displayMatches(value, data) {
        const matchArray = findMatches(value, data);
        const result = matchArray.map(item => {
            const regex = new RegExp(value, 'gi');
            const title = item.title.replace(regex, `<span class="hl">${value}</span>`);
            return `<a href="${location.origin}/product/${item.slug}" class="search-item">
                    <div class="product-img">
                    <img src="${item.photo}" alt="">
                    </div>
                    <div class="product-name">${title}
                    <p class="product-price">${item.price} <span class="rub">₽</span> / ${item.unit_pricing_base_measure}.</p>
                    </div>
                    </a>`;
        }).join('');
        if (result) {
            resultTitle.innerHTML = `(${data.length}) результат поиска: "${value}"`;
            resultBlock.innerHTML = result;
            resultBlock.style = `height: ${document.documentElement.clientHeight - resultBlock.getBoundingClientRect().top + document.body.scrollTop}px; overflow-y: auto;`;
        } else {
            resultBlock.innerHTML = `<p>Ничего не найдено.</p>`;
            resultBlock.removeAttribute('style');
        }
    }

    const searchRequest = (e) => {
        xmlHttpRequest('/autocomplete', {search: e.target.value}, (data) => {
            displayMatches(e.target.value, data);
            searchDropDown.removeAttribute('hidden');
        });
    };
    formSearch.search.addEventListener('keyup', searchRequest);
    formSearch.search.addEventListener('onchange', searchRequest);

    document.addEventListener('click', (event) => {
        toggleShow(event.target, searchDropDown);
    });

})(document.querySelector('.b-search'));
