const cardIcons = {
    favorite: null,
    compare: null,
    card: null,
    init: () => {
        cardIcons.card = document.querySelectorAll(".card__icons");
        if (!cardIcons.card)
            return;

        Array.from(cardIcons.card, (item) => {
            cardIcons.favorite = item.querySelectorAll(".favorite");
            cardIcons.compare = item.querySelectorAll(".compare");
            Array.from(cardIcons.favorite, (item) => {
                if (item.classList.contains('favorite__active')) {
                    item.setAttribute('title', 'Убрать из избранного');
                } else {
                    item.setAttribute('title', 'Добавить в избранное');
                }
                item.onclick = function () {
                    cardIcons.switch(this);
                };
            });
            Array.from(cardIcons.compare, (item) => {
                if (item.classList.contains('compare__active')) {
                    item.setAttribute('title', 'Убрать из сравнения');
                } else {
                    item.setAttribute('title', 'Добавить в сравнение');
                }
                item.onclick = function () {
                    cardIcons.switch(this);
                };
            });
        });
    },
    switch: (elem) => {
        elem.classList.toggle(`${elem.classList[0]}__active`);
        cardIcons.init();
    }
}
window.addEventListener('load', cardIcons.init);

