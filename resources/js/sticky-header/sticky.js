(() => {
    /**
     * @returns {number}
     */
    const getDistance = (el) => {
        return el.offsetTop; // height 33px top-bar
    }

    const subHeader = document.querySelector('.sub-header');
    const logoContainer = document.querySelector('.sub-header__logo-container');
    const homepageTopMenu = document.querySelector('.homepage-top-grid__menu');
    const catalogSpoiler = document.querySelector('.catalog-spoiler-btn');
    const wrapper = document.querySelector('.homepage-top-grid');

    let stuck = false; //
    const stickPoint = getDistance(subHeader);
    /**
     *
     */
    const menuDesktopWrapShowed = (clone) => {
        const arr = wrapper.querySelectorAll('.menu-desktop-wrap_showed');
        if (arr.length === 0) {
            clone.classList.add('menu-desktop-wrap_showed');
            wrapper.appendChild(clone);
        } else {
            arr[0].remove();
        }
    }

    if (catalogSpoiler) {
        // if showed catalog-spoiler-btn
        catalogSpoiler.addEventListener('click', () => {
            const clone = homepageTopMenu.cloneNode(true);
            menuDesktopWrapShowed(clone);
        });
    }
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
        const distanceMenu = (homepageTopMenu.offsetHeight - stickPoint) - window.pageYOffset;
        if ((distance <= 0) && !stuck) {
            subHeader.setAttribute("style", "position: fixed; top: 0 ;");
            stuck = true;
        } else if (stuck && (offset <= stickPoint)) {
            subHeader.style.position = 'static';
            stuck = false;
        }
        menuLargeButton(distanceMenu);
    }
    window.onload = getStuck;
    window.onscroll = getStuck;
})();
