(() => {
// variables
    const prev = document.querySelector('.prev');
    const next = document.querySelector('.next');
    const sliderItems = document.querySelectorAll('.slider__item');
    //const sliderDots = document.querySelector('.slider__dots');
    const sliderContainer = document.querySelector('.slider');

    let index = 0; // Current position
    let pause = 5000;
    let interval;
    /* ============= */
    /* let dots = '';
    sliderItems.forEach((item, i) => {
        dots += `<span class="slider__dots--dot${(index === i) ? ' active' : ''}"></span>`;
    });
    sliderDots.innerHTML = dots;
    const dotsBlock = sliderDots.querySelectorAll('.slider__dots--dot'); */
    /* ============ */

    /**
     * Stop slider
     */
    const stopSlider = () => {
        clearInterval(interval);
    }
    /**
     * Toggle class active
     * @param list
     * @param i
     */
    const addClassActive = (list, i) => {
        /* remove all items class active */
        list.forEach(item => {
            item.classList.remove('active');
        });
        /* Add class active */
        list[i].classList.add('active');
    }
    /**
     *
     * @param i
     */
    const activeSlide = i => {
        addClassActive(sliderItems, i);
    }
    /**
     *
     * @param i
     */
    /* const activeDot = i => {
        addClassActive(dotsBlock, i);
    }*/
    /**
     *
     * @param i
     */
    const prepareCurrentSlide = i => {
        activeSlide(i);
        //activeDot(i);
    }
    /**
     * Next
     */
    const getNext = () => {
        interval = setInterval(() => {
            if ((sliderItems.length - 1) === index) {
                index = 0;
                prepareCurrentSlide(index);
            } else {
                index++;
                prepareCurrentSlide(index);
            }
        }, pause);
    }
    /**
     * Prev
     */
    const getPrev = () => {
        if (0 === index) {
            index = sliderItems.length - 1;
            prepareCurrentSlide(index);
        } else {
            index--;
            prepareCurrentSlide(index);
        }
    }

    /**
     * Dots click event
     */
    /* dotsBlock.forEach((item, i) => {
        item.addEventListener('click', handle => {
            //index = i;
            prepareCurrentSlide(i);
            stopSlider();
        });
    });*/

    next.addEventListener('click', getNext);
    prev.addEventListener('click', getPrev);

    sliderContainer.addEventListener("mouseenter", stopSlider);
    sliderContainer.addEventListener("mouseleave", getNext);

    getNext();
})();
