<?php
/**
 * Simple SPL autoloader for plugin classes.
 *
 * @package Tekbyte_Task_1
 */

namespace TekbyteTask1;

use TekbyteTask1\Support\Singleton;

final class Autoloader {
	use Singleton;

	/**
	 * @var string
	 */
	private $base_dir;

	/**
	 * @var string
	 */
	private $prefix;

	/**
	 * Initialize the autoloader.
	 *
	 * @param string $base_dir Absolute path to `classes/` directory.
	 * @param string $prefix   Namespace prefix to autoload.
	 * @return void
	 */
	public function init( $base_dir, $prefix = 'TekbyteTask1\\' ) {
		$this->base_dir = rtrim( $base_dir, '/\\' ) . DIRECTORY_SEPARATOR;
		$this->prefix   = $prefix;
	}

	/**
	 * Register autoloader.
	 *
	 * @return void
	 */
	public function register() {
		if ( empty( $this->base_dir ) || empty( $this->prefix ) ) {
			return;
		}

		spl_autoload_register( array( $this, 'autoload' ) );
	}

	/**
	 * Autoload callback.
	 *
	 * @param string $class Fully-qualified class name.
	 * @return void
	 */
	public function autoload( $class ) {
		if ( 0 !== strpos( $class, $this->prefix ) ) {
			return;
		}

		$relative = substr( $class, strlen( $this->prefix ) );
		$relative = str_replace( array( '\\', '/' ), DIRECTORY_SEPARATOR, $relative );

		$file = $this->base_dir . $relative . '.php';
		if ( is_file( $file ) ) {
			require_once $file;
		}
	}
}


