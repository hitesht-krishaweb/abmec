        <article class="news-item col-12">
            <a href="<?php the_permalink(); ?>" class="news-item__link">
                <picture>
                    <source media="(min-width: 992px)" srcset="<?php echo get_the_post_thumbnail_url(); ?>">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                </picture>
                <div class="news-item__content">
                    <h2><?php the_title(); ?></h2>
                    <time datetime="2019-08-15"><?php the_weekday(); ?> <?php the_date(); ?></time>
                </div>
            </a>
        </article>

