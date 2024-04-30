'use strict';

document.addEventListener('DOMContentLoaded', () => {
    document.createElement( "picture" );

    fSliders();
    fNavigation();
    fQuickLinks();
    fFilter();
    fDateFix();
});

window.addEventListener('resize', () => {
    fQuickLinks();
});
