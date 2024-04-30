<div class="col-lg-12">
    <?php while (have_posts()): the_post(); ?>
<!--        <h1>--><?php //echo the_title(); ?><!--</h1>-->

        <?php the_content(); ?>

    <?php endwhile; ?>
</div>