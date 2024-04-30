<?php
/**
 * Section Template Media video.
 *
 * @package WordPress.
 */

$g_query = new WP_Query( $args );

if ( $g_query->have_posts() ) : ?>
	<div class="row">
		<?php
		while ( $g_query->have_posts() ) :
			$g_query->the_post();
			?>

		<div class="col-lg-6 col-md-6  gallery-box video-box">
			<div class="mb-4">
				<?php

				if ( has_post_thumbnail() ) {
					$vid_ir           = get_field( 'youtube_video_url' );
					$attachment_image = wp_get_attachment_url( get_post_thumbnail_id() );
					$vid_url          = ( ! empty( $vid_ir ) ) ? $vid_ir : $attachment_image;
					?>
					<a href="<?php echo esc_attr( $vid_url ); ?>" data-fancybox="gallery-<?php the_ID(); ?>">
						<div class="img-box">
							<img class="img" src="<?php echo esc_attr( $attachment_image ); ?>">
							<div class="img-overlay" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/playicon.png'; ?>);">
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
				<h2>Video's not found!</h2>
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
		echo wp_kses_post(
			paginate_links(
				array(
					'base'      => str_replace( array( $big, '&#038;' ), array( '%#%', '&' ), get_pagenum_link( $big ) ),
					'format'    => '?paged=%#%',
					'current'   => max( 1, get_query_var( 'paged' ) ),
					'total'     => $g_query->max_num_pages,
					'type'      => 'list',
					'prev_text' => '«',
					'next_text' => '»',
				)
			)
		);
		?>
	</div>
</div>
