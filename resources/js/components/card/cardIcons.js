const cardIcons = {
    favorite: null,
    compare: null,
    card: null,
    init: () => {
        cardIcons.card = document.querySelectorAll(".card__icons");
        cardIcons.favorite = document.querySelector(".card .favorite");
        cardIcons.compare = document.querySelector(".card .compare");
        if (!cardIcons.favorite || !cardIcons.compare)
            return;

        Array.from(cardIcons.card, (item) => {
            console.log(item.querySelector(".favorite"));
        });
        if (cardIcons.favorite.classList.contains('favorite__active')) {
            cardIcons.favorite.setAttribute('title', 'Убрать из избранного');
        } else {
            cardIcons.favorite.setAttribute('title', 'Добавить в избранное');
        }
        if (cardIcons.compare.classList.contains('compare__active')) {
            cardIcons.compare.setAttribute('title', 'Убрать из сравнения');
        } else {
            cardIcons.compare.setAttribute('title', 'Добавить в сравнение');
        }
        cardIcons.favorite.onclick = function () {
            cardIcons.switch(this);
        };
        cardIcons.compare.onclick = function () {
            cardIcons.switch(this);
        };
    },
    switch: (elem) => {
        elem.classList.toggle(`${elem.classList[0]}__active`);
        cardIcons.init();
    }
}
window.addEventListener('load', cardIcons.init);

