<?php

namespace Custom_Theme\Plugins;

/**
 * Class Gravity_Forms
 *
 * Handles all Gravity Forms related hooks
 *
 * @since      2.0
 *
 * @package    WordPress
 * @subpackage Custom_Theme\Plugins
 */
class Gravity_Forms {
	/**
	 * Gravity_Forms constructor
	 *
	 * @since 2.0
	 */
	public function __construct() {
		add_action( 'wp_print_styles', [ $this, 'remove_gform_stylesheets' ] );
		add_action( 'wp_footer', [ $this, 'remove_gform_stylesheets' ] );
		add_filter( 'gform_init_scripts_footer', '__return_true' );
		add_filter( 'gform_cdata_open', [ $this, 'wrap_gform_cdata_open' ] );
		add_filter( 'gform_cdata_close', [ $this, 'wrap_gform_cdata_close' ] );
		add_filter( 'gform_disable_post_creation', [ $this, 'disable_post_creation' ] );
		add_filter( 'gform_submit_button', [ $this, 'form_submit_button' ], 10, 2 );
	}

	/**
	 * Fixes the jQuery is not defined error when using AJAX forms (opening part)
	 *
	 * @internal This function is hooked on the `gform_cdata_open` filter
	 * @link     https://www.gravityhelp.com/documentation/article/gform_cdata_open/
	 *
	 * @since    4.0
	 *
	 * @param string $content Empty string
	 *
	 * @return string Opening string of document event listener
	 */
	public function wrap_gform_cdata_open( $content = '' ) {
		$content = 'document.addEventListener( "DOMContentLoaded", function() { ';

		return $content;
	}

	/**
	 * Fixes the jQuery is not defined error when using AJAX forms (closing part)
	 *
	 * @internal This function is hooked on the `gform_cdata_open` filter
	 * @link     https://www.gravityhelp.com/documentation/article/gform_cdata_open/
	 *
	 * @since    4.0
	 *
	 * @param string $content Empty string
	 *
	 * @return string Closing string of document event listener
	 */
	public function wrap_gform_cdata_close( $content = '' ) {
		$content = ' }, false );';

		return $content;
	}

	/**
	 * Removes the default Gravity Forms stylesheets
	 * so we can write our own styling for fields
	 *
	 * @internal This function is hooked on the `wp_print_styles` and the `wp_footer` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/wp_print_styles
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer
	 *
	 * @since    2.0
	 *
	 * @return void
	 */
	public function remove_gform_stylesheets() {
		wp_dequeue_style( 'gforms_reset_css' );
		wp_dequeue_style( 'gforms_formsmain_css' );
		wp_dequeue_style( 'gforms_browsers_css' );
	}

	/**
	 * Disable the temp post creation in Gravity Forms
	 *
	 * @internal This function is hooked on the `gform_disable_post_creation` filter
	 * @link     https://www.gravityhelp.com/documentation/article/gform_disable_post_creation
	 *
	 * @since    2.0
	 *
	 * @return bool Always return true so this is disabled by default
	 */
	public function disable_post_creation() {
		return true;
	}

	/**
	 * Convert the Gravity Forms input submit to a button submit
	 *
	 * @internal This function is hooked on the `gform_submit_button` filter
	 * @link     https://www.gravityhelp.com/documentation/article/gform_submit_button/
	 *
	 * @since    4.0.1
	 *
	 * @param string $button HTML string with the input submit
	 * @param array  $form   Array containing all form elements
	 *
	 * @return string HTML string with the formatted button submit
	 */
	public function form_submit_button( $button, $form ) {
		$button = str_replace( '<input', '<button', $button );
		$button = $button . $form['button']['text'] . '</button>';

		return $button;
	}
}
