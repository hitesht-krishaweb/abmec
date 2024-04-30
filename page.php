<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header(); ?>

<?php if (have_posts()): ?>
    <section class="section">
        <article class="page">
            <div class="container">
                <div class="row">

                    <?php get_template_part('template-parts/page', 'content'); ?>
                </div>
            </div>
        </article>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
