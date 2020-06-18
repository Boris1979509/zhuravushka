const tab = {
    nav: null, // holds all tabs
    txt: null, // holds all text containers
    gl: null,
    init: function () {
        // tab.init() : init tab interface

        // Get all tabs + contents
        tab.nav = document.querySelectorAll("nav.tabs-nav .tabs-nav__item");
        tab.txt = document.querySelectorAll(".tabs-content .tabs-content__item");


        // Error checking
        if (tab.nav.length === 0 || tab.txt.length === 0 || tab.nav.length !== tab.txt.length) {
            return;
        } else {
            // Attach onclick events to navigation tabs

            for (let i = 0; i < tab.nav.length; i++) {
                tab.nav[i].dataset.pos = i;
                tab.nav[i].addEventListener("click", tab.switch);
            }

            // Default - show first tab
            tab.nav[0].classList.add("active");
            tab.txt[0].classList.add("active");
            tab.gl = document.querySelector(".tabs-content__item.active .glider");
        }
    },

    switch: function () {
        // tab.switch() : change to another tab

        // Hide all tabs & text
        for (const t of tab.nav) {
            t.classList.remove("active");
        }
        for (const t of tab.txt) {
            t.classList.remove("active");
        }

        // Set current tab
        tab.nav[this.dataset.pos].classList.add("active");
        tab.txt[this.dataset.pos].classList.add("active");
        tab.gl = document.querySelector(".tabs-content__item.active .glider");
        tab.glider();
    },
    glider: function () {
        if (!tab.gl) return;
        const glider = new Glider(tab.gl, {
            //itemWidth: 'auto',
            slidesToShow: 4, // auto
            slidesToScroll: 4, // auto
            propagateEvent: true,
            draggable: true,
            //dots: '.dots',
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            }
        });
    }
};

window.addEventListener("load", () => {
    tab.init();
    tab.glider();
});
