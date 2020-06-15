require('./sticky-header/sticky');
require('./homepage-slider/slider');
require('./accordion/accordion');
import Glider from './components/glider';

new Glider(document.querySelector('.glider'), {
    slidesToShow: 4,
    slidesToScroll: 4,

    draggable: true,
    //dots: '.dots',
    arrows: {
        prev: '.glider-prev',
        next: '.glider-next'
    }
});
