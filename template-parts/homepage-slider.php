<?php

$sliders = get_field('sliders');
?>

<?php if ($sliders): ?>
    <section class="slider__home" data-module-slider>
        <div class="slider glide__track" data-glide-el="track">
            <div class="glide__slides">
				<div class="flexslider">
					<ul class="slides">
                <?php while (have_rows('sliders')): the_row(); ?>
                    <?php
                    $slider = get_sub_field('slider');
                    $button = get_field('button', $slider->ID);
                    $image = get_field('image', $slider->ID);
                    ?>
					<li>
                    <div class="slider__slide glide_slide">
                        <div class="slide__image-container" style="background-image: url('<?php echo $image['url']; ?>');">
                            <!--<img src="<?php //echo $image['url']; ?>" alt="" class="slide__image">-->
                        </div>
                        <div class="slide__content">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-5
                                    <?php echo (get_field('text_left_right', $slider->ID) == "right") ? 'offset-lg-7"' : '"'; ?>
                                    >
                                        <div class="slide__content__inner">
                                            <h2 class="slide__title"><?php echo $slider->post_title; ?></h2>
                                            <p class="slide__text"><?php the_field('slider_text', $slider->ID) ?></p>
                                            <a href="<?php echo $button['url']; ?>" class="button button--white">
                                            <svg class="icon-chevron icon-chevron--right">
                                                <use xlink:href="#chevron"></use>
                                            </svg>
                                            <?php echo $button['title']; ?>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					</li>
                <?php endwhile; ?>
				</ul>
			  </div>
            </div>

            <!--<div class="slider__nav">
                <div class="container">
                    <div class="glide__bullets offset-lg-1" data-glide-el="controls[nav]">

                        <?php for ($i = 0; $i < count($sliders); $i++): ?>
                            <button class="slider__nav__item glide__bullet" aria-label="Naar slide <?php echo $i + 1 ?>"
                                    data-glide-dir="=<?php echo $i; ?>"></button>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>-->
        </div>
    </section>
<?php endif; ?>