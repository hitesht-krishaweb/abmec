<?php
/*
* Template Name: Vestigingen pagina
*/
?>

<?php get_header(); ?>

    <section class="section">
        <!-- <div class="breadcrumbs">
            <div class="container">
                <?php //custom_breadcrumbs(); ?>
            </div>
        </div> -->
        <article>
            <div class="container">
                <div class="row">
                    <?php get_template_part('template-parts/vestigingen', 'content'); ?>
                    <div class="col-lg-4">
                        <aside>
                            <?php the_field('more_info'); ?>
                        </aside>
                    </div>
                </div>
            </div>
        </article>
    </section>


<?php get_footer(); ?>