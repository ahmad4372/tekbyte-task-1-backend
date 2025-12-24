<?php
/**
 * Plugin bootstrap: environment checks + autoload + init.
 *
 * @package Tekbyte_Task_1
 */

namespace TekbyteTask1;

use TekbyteTask1\Support\Singleton;
use TekbyteTask1\PostTypes\CaseStudy;
use TekbyteTask1\Taxonomies\Industry;

final class Bootstrap {
	use Singleton;

	/**
	 * Minimum required versions / dependencies.
	 */
	const MIN_PHP_VERSION = '7.4';
	const MIN_WP_VERSION  = '6.0';

	/**
	 * Kick off plugin.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'plugins_loaded', array( $this, 'maybe_boot' ), 0 );
	}

	/**
	 * @return void
	 */
	public function maybe_boot() {
		$errors = $this->get_environment_errors();
		if ( ! empty( $errors ) ) {
			$this->register_admin_notices( $errors );
			return;
		}

		$this->register_autoloader();
		$this->init_features();
	}

	/**
	 * @return string[] List of human-readable error messages.
	 */
	private function get_environment_errors() {
		$errors = array();

		if ( version_compare( PHP_VERSION, self::MIN_PHP_VERSION, '<' ) ) {
			$errors[] = sprintf(
				'Tekbyte Task 1 requires PHP %1$s or higher. Current PHP: %2$s',
				self::MIN_PHP_VERSION,
				PHP_VERSION
			);
		}

		global $wp_version;
		$wp_version = isset( $wp_version ) ? $wp_version : '0.0';
		if ( version_compare( $wp_version, self::MIN_WP_VERSION, '<' ) ) {
			$errors[] = sprintf(
				'Tekbyte Task 1 requires WordPress %1$s or higher. Current WordPress: %2$s',
				self::MIN_WP_VERSION,
				$wp_version
			);
		}

		if ( ! $this->is_plugin_active( 'advanced-custom-fields/acf.php' ) && ! $this->is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
			$errors[] = 'Tekbyte Task 1 requires ACF (Advanced Custom Fields). Please install and activate it.';
		}

		if ( ! $this->is_plugin_active( 'wp-graphql/wp-graphql.php' ) ) {
			$errors[] = 'Tekbyte Task 1 requires WPGraphQL. Please install and activate it.';
		}

		return $errors;
	}

	/**
	 * @param string[] $errors
	 * @return void
	 */
	private function register_admin_notices( array $errors ) {
		add_action(
			'admin_notices',
			function () use ( $errors ) {
				foreach ( $errors as $error ) {
					printf(
						'<div class="notice notice-error"><p>%s</p></div>',
						esc_html( $error )
					);
				}
			}
		);
	}

	/**
	 * @return void
	 */
	private function register_autoloader() {
		Autoloader::get_instance()->init( TEKBYTE_TASK_1_CLASSES_DIR );
		Autoloader::get_instance()->register();
	}

	/**
	 * @return void
	 */
	private function init_features() {
		CaseStudy::get_instance()->init();
		Industry::get_instance()->init();
		Config::get_instance()->init();
	}

	/**
	 * Minimal plugin active check (works even if `is_plugin_active` isn't loaded yet).
	 *
	 * @param string $plugin Relative plugin path, e.g. `advanced-custom-fields/acf.php`.
	 * @return bool
	 */
	private function is_plugin_active( $plugin ) {
		if ( function_exists( 'is_plugin_active' ) ) {
			return is_plugin_active( $plugin );
		}

		if ( ! function_exists( 'get_option' ) ) {
			return false;
		}

		$active = (array) get_option( 'active_plugins', array() );
		if ( in_array( $plugin, $active, true ) ) {
			return true;
		}

		// Multisite.
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			$network_active = (array) get_site_option( 'active_sitewide_plugins', array() );
			return isset( $network_active[ $plugin ] );
		}

		return false;
	}
}


