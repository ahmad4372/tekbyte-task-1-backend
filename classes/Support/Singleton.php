<?php
/**
 * Singleton trait for plugin classes.
 *
 * @package Tekbyte_Task_1
 */

namespace TekbyteTask1\Support;

trait Singleton {
	/**
	 * @var static|null
	 */
	private static $instance = null;

	/**
	 * Get class instance.
	 *
	 * @return static
	 */
	final public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Protected constructor to prevent direct creation.
	 */
	protected function __construct() {}

	/**
	 * Prevent cloning.
	 *
	 * @return void
	 */
	private function __clone() {}

	/**
	 * Prevent unserializing.
	 *
	 * @return void
	 */
	public function __wakeup() {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		_doing_it_wrong( __FUNCTION__, 'Unserializing instances of this class is forbidden.', '0.1.0' );
	}
}


