((elem) => {
    if (!elem)
        return;
    new Glider(elem, {
        slidesToShow: 'auto',
        slidesToScroll: 'auto',
        itemWidth: 300,
        duration: 0.25,
        propagateEvent: false,
        draggable: false,
       dots: '#more-goods-dots',
        arrows: {
            prev: '#glider-prev-more-goods',
            next: '#glider-next-more-goods'
        }
    });
})(document.getElementById('more-goods'));

