((elem) => {
    if (!elem)
        return;
    const glider = new Glider(elem, {
        //itemWidth: 'auto',
        slidesToShow: 1, // auto
        slidesToScroll: 1, // auto
        propagateEvent: false,
        draggable: false,
        arrows: {
            prev: '#glider-prev-leaders-sales',
            next: '#glider-next-leaders-sales'
        },
        responsive: [
            {
                // screens greater than >= 775px
                breakpoint: 775,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    itemWidth: 150,
                    duration: 0.25
                }
            },
            {
                // screens greater than >= 1199px
                breakpoint: 1199,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    itemWidth: 150,
                    duration: 0.25
                }
            }

        ]
    });
})(document.getElementById('glider-leader-sales'));

