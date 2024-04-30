<?php
/*
* Template Name: Content pagina met 1 sidebar block
*/
?>

<?php get_header(); ?>
<?php get_template_part('template-parts/page', 'banner'); ?>
<?php get_template_part('template-parts/page', 'submenu'); ?>

<?php if (have_posts()): ?>
    <section class="section">
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
						<?php $sidebar_button = get_field('sidebar_button'); 
						if($sidebar_button){
							$cls = "class='sidebar-cta-widget'";
						?>
						<div class="sidebar-cta">
							<a href="<?php echo $sidebar_button['url']; ?>"><?php echo $sidebar_button['title']; ?></a>
						</div>
						<?php } ?>
                        <aside <?php echo $cls;?>>
                            <?php the_field('more_info'); ?>
                        </aside>
                    </div>

                </div>
            </div>
        </article>
    </section>
<?php endif; ?>

<?php include('footer.php') ?>