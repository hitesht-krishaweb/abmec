<?php

namespace Custom_Theme\Setup;

/**
 * Class Registrations
 *
 * Here are all registrations for custom post types
 * and custom taxonomies.
 *
 * @since      1.0
 *
 * @package    WordPress
 * @subpackage Custom_Theme\Setup
 */
class Registrations {
	/**
	 * Registrations constructor
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_custom_post_types' ], 0 );
		add_action( 'init', [ $this, 'register_taxonomies' ], 0 );
	}

	/**
	 * Register theme custom post types
	 *
	 * @internal This function uses the `init` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/init
	 *
	 * @since    1.0
	 *
	 * @return void
	 */
	public function register_custom_post_types() {
		register_post_type( 'slider',
			[
				'labels'             => [
					'name'          => ( 'Sliders' ),
					'singular_name' => ( 'Slider' ),
					'menu_name'     => ( 'Sliders' ),
				],
				'public'             => true,
				'publicly_queryable' => true,
				'menu_icon'          => 'dashicons-slides',
				'has_archive'        => true,
				'rewrite'            => [ 'slug' => ( 'slide' ) ],
				'supports'           => [
					'title',
					'thumbnail',
				],
			]
		);
	}

	/**
	 * Register theme custom taxonomies
	 *
	 * @internal This function uses the `init` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/init
	 *
	 * @since    1.0
	 *
	 * @return void
	 */
	public function register_taxonomies()
    {
    }
}
