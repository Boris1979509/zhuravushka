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

    let stuck = false; //
    const stickPoint = getDistance(subHeader);

    /**
     * Stick menu large button
     * @param item
     */
    const menuLargeButton = (item) => {
        (item <= 0) ? logoContainer.classList.add('large-btn') :
            logoContainer.classList.remove('large-btn');
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
