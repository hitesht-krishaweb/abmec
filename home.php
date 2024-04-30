<?php get_header(); ?>
<?php $query = new WP_Query(array('post__in' => get_option('sticky_posts'))); ?>
<?php global $wp_query; ?>

<?php if ($query->have_posts()): ?>
    <?php while ($query->have_posts()): $query->the_post(); ?>
        <div class="banner">
            <div class="banner__content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-8 col-xl-5 offset-xl-7">
                            <div class="banner__content__inner">
                                <h1 class="banner__title"><?php the_title(); ?></h1>
                                <p class="banner__text"><?php echo get_the_excerpt(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="button button--white">
                                    <svg class="icon-chevron icon-chevron--right">
                                        <use xlink:href="#chevron"></use>
                                    </svg>
                                    Lees verder
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <picture>
                <source media="(min-width: 1200px)" srcset="<?php the_post_thumbnail_url(); ?>">
                <source media="(min-width: 992px)" srcset="<?php the_post_thumbnail_url(); ?>">
                <source media="(min-width: 576px)" srcset="<?php the_post_thumbnail_url(); ?>">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="">
            </picture>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
<section class="section">
    <div class="breadcrumbs">
        <div class="container">
            <div class="col-lg-12">
                <?php custom_breadcrumbs(); ?>
            </div>
        </div>
    </div>
</section>

<div class="news-list 232323">
    <div class="container">

        <?php $args = ['ignore_sticky_posts' => 1]; ?>

        <?php $query = new WP_Query(array('post__not_in' => get_option('sticky_posts'))); ?>

        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <div class="row">
                    <?php get_template_part('template-parts/news', 'item'); ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
            <button class="row show_more button button--primary">Toon meer<svg class="icon-chevron icon-chevron--down icon-chevron--white"><use xlink:href="#chevron"></use></svg></button>
            <?php endif;?>
    </div>
</div>
<?php get_footer(); ?>
