<?php

namespace Custom_Theme\Setup;

/**
 * Class Options
 *
 * This class registers the ACF option pages
 *
 * @since      2.0
 *
 * @package    WordPress
 * @subpackage Custom_Theme\Setup
 */
class Options {
	/**
	 * Options constructor
	 *
	 * @since 2.0
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'theme_option_pages' ] );
	}

	/**
	 * Defines the additional ACF option pages
	 *
	 * @internal This function uses the `init` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/init
	 *
	 * @since    2.0
	 *
	 * @return void
	 */
	public function theme_option_pages() {

		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( [
				'page_title' => ( 'Theme options' ),
				'menu_title' => ( 'Theme options' ),
				'menu_slug'  => 'options-theme',
				'capability' => 'edit_posts',
			] );
		}

		if ( function_exists( 'acf_add_options_sub_page' ) ) {
			acf_add_options_sub_page( [
				'page_title' => ( 'General' ),
				'menu_title' => ( 'General' ),
				'menu_slug'  => 'options-theme-general',
				'parent'     => 'options-theme',
				'capability' => 'edit_posts',
			] );
		}
	}
}
