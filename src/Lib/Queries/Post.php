<?php

namespace Custom_Theme\Queries;

/**
 * Class Post
 *
 * This is the place to hook on to the main query
 * for this particular custom post type
 *
 * @since      3.4.6
 *
 * @package    WordPress
 * @subpackage Custom_Theme\Queries
 */
class Post {
	/**
	 * Post constructor
	 *
	 * @since 3.4.6
	 */
	public function __construct() {
		add_filter( 'pre_get_posts', [ $this, 'adjust_main_queries' ] );
	}

	/**
	 * Adjust the main query for the page
	 *
	 * This function is most used for the loop on archive pages or
	 * taxonomy overview pages.
	 *
	 * @internal This function is hooked on the `pre_get_posts` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
	 *
	 * @since    2.0
	 *
	 * @param \WP_Query $query Object containing the query structure
	 *
	 * @return \WP_Query Modified query object prepared for execution
	 */
	public function adjust_main_queries( $query ) {
		if ( ! is_admin() && $query->is_main_query() ) {

			if ( is_post_type_archive( 'vertel' ) || is_tax( 'vertel_cat' ) ) {
				$query->set( 'posts_per_page', 13 );
                $query->set( 'post_type', array( 'vertel' ) );

				if ( is_post_type_archive( 'vertel' ) && isset( $_GET['qs'] ) && ! empty( $_GET['qs'] ) ) {

					$qs     = ( isset( $_GET['qs'] ) && ! empty( $_GET['qs'] ) ) ? esc_attr( $_GET['qs'] ) : null;
					$qs_arr = explode( '|', $qs );

					if ( ! empty( $qs_arr ) && is_array( $qs_arr ) ) {
						$taxquery = [
							[
								'taxonomy' => 'vertel_cat',
								'field'    => 'id',
								'terms'    => $qs_arr,
							]
						];

						$query->set( 'tax_query', $taxquery );
					}
				}
			}
		}
//
//		echo '<pre>';
//		var_dump($query);

		return $query;
	}
}
