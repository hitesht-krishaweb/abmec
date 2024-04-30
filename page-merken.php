<?php
/*
* Template Name: Merken
*/
?>

<?php get_header(); ?>

<section class="section">
        <div class="breadcrumbs">
            <div class="container">
                <?php custom_breadcrumbs(); ?>
            </div>
        </div>
		<article>
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<h1>Merken</h1>
						<?php $count = 0; 
						if( have_rows('merken') ): ?>
						<ul class="logos-wrap">
							<?php 
							while( have_rows('merken') ) : the_row();
							$count++;
							
							$merk_image = get_sub_field('merk_image'); 
							$merk_url = get_sub_field('merk_url');
							?>
							<li>
								<a href="<?php echo $merk_url; ?>" target="_blank"><img src="<?php echo $merk_image; ?>" alt=""></a>
							</li>
							<?php 
								
							/* if($count % 4 == 0){
								echo '</ul><ul class="logos-wrap">';
							} */
							?>
							<?php
							endwhile;
							?>
						</ul>
						<?php endif; ?>
					</div>
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