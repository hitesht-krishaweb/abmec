function fSliders() {
    const oSliders = document.querySelectorAll('[data-module-slider]');

    if (oSliders) {
        oSliders.forEach((slider) => {
            const sliderThumbs = slider.querySelector('[data-module-slider-thumbs]');
            const glide = new Glide(slider, {
                type: 'carousel',
                gap: 0,
                autoplay: slider.getAttribute('data-autoplay') ? parseInt(slider.getAttribute('data-autoplay'), 10) : false
            }).mount();

            if (sliderThumbs) {
                const glideThumbs = new Glide(sliderThumbs, {
                    type: 'slider',
                    focusAt: '0',
                    gap: 5,
                    perView: 5,
                    peek: 20,
                    rewind: true,
                }).mount();

                glide.on('run.after', () => {
                    glideThumbs.go(`=${glide.index}`);
                })
            }
        });
    }
}