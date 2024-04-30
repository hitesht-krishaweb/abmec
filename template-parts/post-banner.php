<?php $banner = get_field('banner'); ?>

    <div class="banner">
        <picture>
            <div class="slide__image-container">
                <img src="<?php echo $banner['url']; ?>" alt="" class="slide__image">
            </div>
            <div class="slide__content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="slide__content__inner">
                                <h1 class="banner__title"><?php echo the_title() ?></h1>
                                <time class="banner__text" datetime="2019-08-15"><?php the_weekday(); ?> <?php echo get_the_date(); ?></time>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </picture>
    </div>
