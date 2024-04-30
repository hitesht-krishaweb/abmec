<?php

?>

<?php get_header(); ?>

<?php if (have_posts()): ?>
    <?php

    $banner = get_field('banner');
    ?>

    <?php if ($banner): ?>
    <?php get_template_part('template-parts/post', 'banner'); ?>

    <?php endif ?>
    <section class="section">
        <div class="breadcrumbs">
            <div class="container">
                <a href="<?php echo get_post_type_archive_link( 'post' ) ?>" class="breadcrumbs__back">
                    <svg class="icon-chevron icon-chevron--left"><use xlink:href="#chevron"></use></svg>
                    Terug
                </a>
                <?php custom_breadcrumbs(); ?>
            </div>
        </div>
        <article>
            <div class="container">
                <div class="row">
                    <?php if (!$banner): ?>
                        <div class="col-lg-12">
                            <h1><?php the_title(); ?></h1>
                            <p><time datetime="2019-08-15"><?php the_weekday(); ?> <?php echo get_the_date(); ?></time></p>
                        </div>
                    <?php endif ?>
                    <?php get_template_part('template-parts/page', 'news'); ?>
                </div>
            </div>
        </article>
    </section>
<?php endif; ?>

<?php get_footer(); ?>