function fNavigation() {
    const navToggle = document.querySelector('[data-module-nav-toggle]');
    const navBar = document.querySelector('[data-module-nav]');
    let subMenuToggles;

    if (navBar) {
        subMenuToggles = navBar.querySelectorAll('.has-sub > a');
    }

    function toggleNavigation() {
        if (navBar.classList.contains('nav--open')) {
            navBar.classList.remove('nav--open');
            navToggle.classList.remove('is-active');
        } else {
            navBar.classList.add('nav--open');
            navToggle.classList.add('is-active');
        }
    }

    function toggleSubnavigation(e, toggle) {
        e.preventDefault();
        let parentEl = toggle.parentElement;
        if (parentEl.classList.contains('is-open')) {
            parentEl.classList.remove('is-open');
        } else {
            parentEl.classList.add('is-open');
        }
    }

    if (navToggle) {
        navToggle.addEventListener('click', toggleNavigation);
    }

    if (subMenuToggles) {
        subMenuToggles.forEach((toggle) => {
            toggle.addEventListener('touchend', (e) => {
                 toggleSubnavigation(e, toggle);
            });
        });
    }
}