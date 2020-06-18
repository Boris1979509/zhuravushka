((elem) => {
    if (!elem)
        return;
    const glider = new Glider(elem, {
        //itemWidth: 'auto',
        slidesToShow: 5, // auto
        slidesToScroll: 5, // auto
        propagateEvent: false,
        draggable: false,
        arrows: {
            prev: '#glider-prev-leaders-sales',
            next: '#glider-next-leaders-sales'
        }
    });
})(document.getElementById('glider-leader-sales'));

