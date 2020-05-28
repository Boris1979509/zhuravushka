(() => {
    /**
     * @returns {number}
     */
    const getDistance = () => {
        let topDist = subHeader.offsetTop; // height 33px top-bar
        return topDist;
    }

    const subHeader = document.querySelector('.sub-header');
    const logoContainer = document.querySelector('.sub-header__logo-container');
    let stuck = false; //
    const stickPoint = getDistance();

    const getStuck = () => {
        const distance = getDistance() - window.pageYOffset;
        const offset = window.pageYOffset;

        if ((distance <= 0) && !stuck) {
            subHeader.style.position = 'fixed';
            logoContainer.classList.add('large-btn');
            subHeader.style.top = '0px';
            stuck = true;
        } else if (stuck && (offset <= stickPoint)) {
            subHeader.style.position = 'static';
            logoContainer.classList.remove('large-btn');
            stuck = false;
        }
    }
    window.onload = getStuck;
    window.onscroll = getStuck;
})();
