(() => {
    /**
     * @returns {number}
     */
    const getDistance = (el) => {
        return el.offsetTop; // height 33px top-bar
    }

    const subHeader = document.querySelector('.sub-header');
    const logoContainer = document.querySelector('.sub-header__logo-container');
    const homepageTopMenu = document.querySelector('.page-top-grid__menu');
    const catalogSpoiler = document.querySelector('.catalog-spoiler-btn');
    const wrapper = document.querySelector('.page-top-grid');

    let stuck = false; //
    const stickPoint = getDistance(subHeader);
    /**
     *
     */
    const menuDesktopWrapShowed = (clone) => {
        const arr = wrapper.querySelectorAll('.menu-desktop-wrap_showed');
        if (0 === arr.length) {
            clone.classList.add('menu-desktop-wrap_showed');
            wrapper.appendChild(clone);
        } else {
            arr[0].remove();
        }
    }
    /**
     *
     * @param elem
     */
    const cloneMenu = (elem) => {
        if (!elem) return;
        if (catalogSpoiler) {
            // if showed catalog-spoiler-btn
            catalogSpoiler.addEventListener('click', () => {
                const clone = elem.cloneNode(true);
                menuDesktopWrapShowed(clone);
            });
        }
    }
    cloneMenu(homepageTopMenu);

    /**
     * Stick menu large button
     * @param item
     */
    const menuLargeButton = (item) => {

        if (item <= 0) {
            logoContainer.classList.add('large-btn');
        } else {
            logoContainer.classList.remove('large-btn');

            const selector = wrapper.querySelector('.menu-desktop-wrap_showed');
            if (selector) selector.remove();
        }
    }

    const getStuck = () => {
        const distance = getDistance(subHeader) - window.pageYOffset;
        const offset = window.pageYOffset;
        // if isset menu
        const distanceMenu = (homepageTopMenu) ? (homepageTopMenu.offsetHeight - stickPoint) - window.pageYOffset : null;
        if ((distance <= 0) && !stuck) {
            if (!distanceMenu) {
                logoContainer.classList.add('large-btn');
            }
            subHeader.setAttribute("style", "position: fixed; top: 0;");
            stuck = true;
        } else if (stuck && (offset <= stickPoint)) {
            subHeader.style.position = 'static';
            stuck = false;
        }
        if (distanceMenu)
            menuLargeButton(distanceMenu);
    }
    // Events
    window.onload = getStuck;
    window.onscroll = getStuck;

    // document.addEventListener('click', function (event) {
    //     const e = document.querySelector('.menu-desktop-wrap_showed');
    //     if (e.contains(event.target)) {
    //         return;
    //     }
    //     e.style.display = 'none';
    // });

})();
