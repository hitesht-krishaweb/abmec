<?php get_header(); ?>

<section class="section">
    <article>
        <div class="container">
            <h1>Pagina niet gevonden!</h1>
            <?php the_field('404_page', 'options'); ?>
        </div>
    </article>
</section>
<?php get_footer(); ?>
