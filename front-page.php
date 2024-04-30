<?php
/*
 * Template Name: Home page
 */
?>
<?php get_header(); ?>

<?php get_template_part('template-parts/homepage', 'slider'); ?>

<?php get_template_part('template-parts/homepage', 'quicklinks'); ?>

<?php get_template_part('template-parts/homepage', 'post-grid'); ?>

<?php get_template_part('template-parts/homepage', 'double-banner'); ?>

<?php //get_template_part('template-parts/homepage', 'brands'); ?>
<style type="text/css">.footer__main .footer__cutout { fill: #ededed; }</style>
<?php get_footer(); ?>