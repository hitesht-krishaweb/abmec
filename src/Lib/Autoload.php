<?php

namespace Custom_Theme;

/**
 * Class Autoload
 *
 * @package    WordPress
 * @subpackage Custom_Theme
 */
class Autoload {
	/**
	 * An associative array where the key is a namespace prefix and the value
	 * is an array of base directories for classes in that namespace
	 *
	 * @var array
	 */
	protected $prefixes = [];

	/**
	 * Array containing the loaded classes
	 *
	 * @var array
	 */
	protected $loaded = [];

	/**
	 * Register loader with SPL autoloader stack
	 */
	public function register() {
		spl_autoload_register( [ $this, 'load_class' ] );

		$this->register_functions();
	}

	/**
	 * Adds a base directory for a namespace prefix
	 *
	 * @param      $prefix
	 * @param      $base_dir
	 * @param bool $prepend
	 */
	public function add_namespace( $prefix, $base_dir, $prepend = false ) {
		// Normalize namespace prefix
		$prefix = trim( $prefix, '\\' );

		// Normalize the base directory with a trailing separator
		$base_dir = rtrim( $base_dir, DIRECTORY_SEPARATOR ) . '/';

		// Initialize the namespace prefix array
		if ( isset( $this->prefixes[ $prefix ] ) === false ) {
			$this->prefixes[ $prefix ] = [];
		}

		// Retain the base directory for the namespace prefix
		if ( $prepend ) {
			array_unshift( $this->prefixes[ $prefix ], $base_dir );
		} else {
			array_push( $this->prefixes[ $prefix ], $base_dir );
		}
	}

	/**
	 * Loads the class file for a given class name
	 *
	 * @param $class
	 *
	 * @return bool|mixed
	 */
	public function load_class( $class ) {
		// The current namespace prefix
		$prefix = $class;

		// Work backwards through the namespace names of the fully-qualified class name to find a mapped file name
		while ( false !== $pos = strrpos( $prefix, '\\' ) ) {

			// Retain the trailing namespace separator in the prefix
			$prefix = substr( $class, 0, $pos + 1 );

			// The rest is the relative class name
			$relative_class = substr( $class, $pos + 1 );

			// Try to load a mapped file for the prefix and relative class
			$mapped_file = $this->load_mapped_file( $prefix, $relative_class );
			if ( $mapped_file ) {
				return $mapped_file;
			}

			// Remove the trailing namespace separator for the next iteration of strrpos()
			$prefix = rtrim( $prefix, '\\' );
		}

		// Never found a mapped file
		return false;
	}

	/**
	 * Register generic theme functions
	 */
	protected function register_functions() {
		$path    = dirname( dirname( dirname( __FILE__ ) ) ) . '/functions';
		$objects = new \RecursiveIteratorIterator( new \RecursiveDirectoryIterator( $path, \RecursiveDirectoryIterator::SKIP_DOTS ) );

		foreach ( $objects as $name ) {
			if ( stripos( $name, '.php' ) !== false ) {
				require_once $name;
			}
		}

		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	/**
	 * Load the mapped file for a namespace prefix and relative class
	 *
	 * @param $prefix
	 * @param $relative_class
	 *
	 * @return bool|string
	 */
	protected function load_mapped_file( $prefix, $relative_class ) {
		// Are there any base directories for this namespace prefix?
		if ( isset( $this->prefixes[ $prefix ] ) === false ) {
			return false;
		}

		// Look through base directories for this namespace prefix
		foreach ( $this->prefixes[ $prefix ] as $base_dir ) {
			$file = $base_dir
			        . str_replace( '\\', '/', $relative_class )
			        . '.php';

			// If the mapped file exists, require it
			if ( $this->require_file( $file ) ) {
				return $file;
			}
		}

		// Never found it
		return false;
	}

	/**
	 * If a file exists, require it from the file system
	 *
	 * @param $file
	 *
	 * @return bool
	 */
	protected function require_file( $file ) {
		if ( file_exists( $file ) ) {
			require $file;

			return true;
		}

		return false;
	}

	/**
	 * Load directory contents
	 *
	 * @since 4.0
	 *
	 * @param string $dir     The directory path which need to be scanned
	 * @param array  $results Array containing files so far
	 *
	 * @return array A full array containing all files found
	 */
	protected function get_directory_contents( $dir, &$results = [] ) {
		$files = scandir( $dir );

		foreach ( $files as $key => $value ) {
			$path = realpath( $dir . DIRECTORY_SEPARATOR . $value );

			if ( ! is_dir( $path ) ) {
				if ( stripos( $path, '.php' ) !== false ) {
					$results[] = $path;
				}
			} else if ( $value !== '.' && $value !== '..' ) {
				$this->get_directory_contents( $path, $results );
			}
		}

		return $results;
	}

	/**
	 * Init the loaded classes
	 */
	public function init() {
		// Register classes
		foreach ( $this->prefixes as $namespace => $path ) {
			$objects = new \RecursiveIteratorIterator( new \RecursiveDirectoryIterator( $path[0], \RecursiveDirectoryIterator::SKIP_DOTS ) );

			foreach ( $objects as $name ) {
				if ( stripos( $name, '.php' ) !== false && stripos( $name, 'Autoload.php' ) === false ) {
					require_once $name;
					$class          = '\\' . $namespace . str_replace( [ rtrim( $path[0], '/' ), '.php', '/' ], [
							'',
							'',
							'\\'
						], $name );
					$this->loaded[] = new $class;
				}
			}
		}
	}

}
