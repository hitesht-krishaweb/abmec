<?php get_header(); ?>
<section class="section">
    <div class="container">
        <?php while (have_posts()): the_post(); ?>

        <?php the_content(); ?>
            <a href="<?php the_permalink(); ?>"><h2>Abemec <?php echo the_title(); ?></h2></a>
        <?php endwhile; ?>
    </div>
</section>
<?php get_footer(); ?>