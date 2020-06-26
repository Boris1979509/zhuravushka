((elem) => {
    if (!elem)
        return;
    const glider = new Glider(elem, {
        //itemWidth: 'auto',
        slidesToShow: 2, // auto
        slidesToScroll: 2, // auto
        propagateEvent: false,
        draggable: false,
        dots: '#moreGoodsDots',
        arrows: {
            prev: '#glider-prev-moreGoods',
            next: '#glider-next-moreGoods'
        }
    });
})(document.getElementById('moreGoods'));

