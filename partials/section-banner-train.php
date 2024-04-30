<?php
/**
 * Banner Section for Trainning Pages
 *
 * @package WordPress.
 */

$banner = get_field( 'banner_image' );
if ( $banner ) : ?>

	<div class="banner">
		<picture>
			<img src="<?php echo esc_url( $banner ); ?>" alt="" class="slide__image">
		</picture>
	</div>
<?php endif; ?>
