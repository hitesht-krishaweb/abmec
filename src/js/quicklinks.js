function fQuickLinks() {
    let navWidth = 0;
    const oNav = document.querySelector('[data-module-quicklinks]');
    if (oNav) {
        const oMore = document.querySelector('[data-module-quicklinks-more]')
        const moreWidth = oMore.offsetWidth > 0 ? oMore.offsetWidth : parseInt(oMore.getAttribute('data-width'), 10);
        const oNavItems = document.querySelectorAll('[data-module-quicklinks] > li:not([data-module-quicklinks-more]');

        oNavItems.forEach((item) => {
            navWidth += item.offsetWidth;
        });

        let availableSpace = oNav.offsetWidth - moreWidth;

        if (navWidth > availableSpace) {
            let lastItem = oNavItems[oNavItems.length - 1]

            lastItem.setAttribute('data-width', lastItem.offsetWidth);
            oMore.querySelector('ul').prepend(lastItem);

            fQuickLinks();
        } else {
            let firstMoreElement = oMore.querySelectorAll('li')[0];

            if (firstMoreElement) {
                if (navWidth + parseInt(firstMoreElement.getAttribute('data-width'), 10) < availableSpace) {
                    oNav.insertBefore(firstMoreElement, oMore);
                }
            }
        }

        if (oMore.querySelectorAll('li').length > 0) {
            oMore.style.display = 'inline-block';
        } else {
            oMore.style.display = 'none';
        }
    }
}