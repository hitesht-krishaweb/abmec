<?php
/*
* Template Name: Content pagina met 2 sidebar blocks
*/

?>

<?php get_header(); ?>


<?php if (have_posts()): ?>
    <section class="section">
        <?php get_template_part('template-parts/page', 'banner'); ?>
        <?php get_template_part('template-parts/page', 'submenu'); ?>
        <div class="breadcrumbs">
            <div class="container">
                <?php custom_breadcrumbs(); ?>
            </div>
        </div>
        <article>
            <div class="container">
                <div class="row">

                    <?php get_template_part('template-parts/page', 'content'); ?>
                    <div class="col-lg-4">
                        <aside>
                            <?php the_field('more_info'); ?>
                            <?php the_field('vestigingen'); ?>
                        </aside>
                    </div>

                </div>
            </div>



        </article>
    </section>
<?php endif; ?>

<?php include('footer.php') ?>