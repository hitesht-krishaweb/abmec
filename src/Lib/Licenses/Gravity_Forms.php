<?php

namespace Custom_Theme\Licenses;

/**
 * Class Gravity_Forms
 *
 * Installs the license for Gravity Forms
 *
 * @since      1.0
 *
 * @package    WordPress
 * @subpackage Custom_Theme\Licenses
 */
class Gravity_Forms {
	/**
	 * Gravity_Forms constructor
	 *
	 * @since 1.0
	 */
	public function __construct() {
		if ( is_admin() && is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
			// Gravity Forms uses the `GF_LICENSE_KEY` constant to check the license
			define( 'GF_LICENSE_KEY', 'b8059c0be8cffefbab0d4c9e5bd38533' );
		}
	}
}
