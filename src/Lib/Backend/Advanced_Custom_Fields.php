<?php

namespace Custom_Theme\Backend;

/**
 * Class Advanced_Custom_Fields
 *
 * Handles all base ACF related hooks
 *
 * @since      3.0
 *
 * @package    WordPress
 * @subpackage Custom_Theme\Backend
 */
class Advanced_Custom_Fields {
	/**
	 * Advanced_Custom_Fields constructor
	 *
	 * @since 3.0
	 */
	public function __construct() {
		add_filter( 'acf/settings/save_json', [ $this, 'acf_json_save_point' ] );
		add_filter( 'acf/settings/load_json', [ $this, 'acf_json_load_point' ] );
		add_action( 'acf/init', [ $this, 'google_api_key' ] );
	}

	/**
	 * Update the ACF json saving path
	 *
	 * @internal This function uses the `acf/settings/save_json` filter
	 * @link     https://www.advancedcustomfields.com/resources/local-json
	 *
	 * @since    3.0
	 *
	 * @param string $path The path to the JSON save point
	 *
	 * @return string The adjusted path
	 */
	public function acf_json_save_point( $path ) {
		$path = get_template_directory() . '/src/field-groups';

		return $path;
	}

	/**
	 * Update the ACF json loading path
	 *
	 * @internal This function uses the `acf/settings/load_json` filter
	 * @link     https://www.advancedcustomfields.com/resources/local-json
	 *
	 * @since    3.0
	 *
	 * @param array $paths Array containing JSON paths
	 *
	 * @return array Adjusted array including custom path
	 */
	public function acf_json_load_point( $paths ) {
		// Add custom path
		$paths[] = get_template_directory() . '/src/field-groups';

		return $paths;
	}

	/**
	 * It may be necessary to register a Google API key in order to allow the Google API to load correctly.
	 * The API key can be set in the Theme options
	 *
	 * @internal This function uses the `acf/init` action
	 * @link     https://www.advancedcustomfields.com/resources/acfinit
	 *
	 * @since    3.0
	 *
	 * @return void
	 */
	public function google_api_key() {
		acf_update_setting( 'google_api_key', get_field( 'google_api_key', 'option' ) );
	}
}
