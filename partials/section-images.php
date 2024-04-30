<?php

$g_query = new WP_Query( $args );

if ( $g_query->have_posts() ) : ?>
	<div class="row">
		<?php
		while ( $g_query->have_posts() ) :
			$g_query->the_post();
			?>

		<div class="col-lg-4 col-md-6  gallery-box">
			<div class="mb-4">
				<?php
				$images = get_field( 'image-gallery' );
				if ( ! empty( $images ) ) :
					?>
					<div style="display:none;">
						<?php foreach ( $images as $image_url ) : ?>
							<a href="<?php echo esc_attr( $image_url ); ?>" data-fancybox="gallery-<?php the_ID(); ?>">
							<img loading="lazy" class="img" src="<?php echo esc_attr( $image_url ); ?>">
							</a>
						<?php endforeach; ?>
					</div>
					<?php
				endif;

				if ( has_post_thumbnail() ) {
					$attachment_image = wp_get_attachment_url( get_post_thumbnail_id() );
					?>
					<a href="<?php echo esc_attr( $attachment_image ); ?>" data-fancybox="gallery-<?php the_ID(); ?>">
						<div class="img-box">
							<img class="img" src="<?php echo esc_attr( $attachment_image ); ?>">
							<div class="img-overlay" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/eyes.png'; ?>);">
								<p>Bekijk</p>
							</div>
						</div>
					</a>	
				<?php } ?>
				<p class="gallery-title"><?php the_title(); ?></p>
			</div>
		</div>

		<?php endwhile; ?>
		</div>
		<?php else : ?>
		<div class="row">
			<div class='col-12'>
				<h2>Foto's not found!</h2>
			</div>
		</div>
			<?php
endif;
		wp_reset_postdata();
		?>
<div class="row">
	<div class='col-12 mt-4 mb-sm-3 pagination d-flex justify-content-center'>
		<?php
		$big = 999999999;
		echo paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $g_query->max_num_pages,
				'type'      => 'list',
				'prev_text' => '«',
				'next_text' => '»',
			)
		);
		?>
	</div>
</div>
