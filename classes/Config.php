<?php
/**
 * Plugin config.
 *
 * @package Tekbyte_Task_1
 */

namespace TekbyteTask1;

use TekbyteTask1\Support\Singleton;

class Config {
	use Singleton;

	/**
	 * Register WP hooks.
	 *
	 * @return void
	 */
	public function init() {
		add_filter( 'rest_url', array( $this, 'api_url' ) );
		add_filter( 'preview_post_link', array( $this, 'preview_link' ), 10, 2 );
	}

	/**
	 * Changes the REST API root URL to use the home URL as the base.
	 *
	 * @param string $url The complete URL including scheme and path.
	 * @return string The REST API root URL.
	 */
	public function api_url( $url ) {
		return str_replace( home_url(), site_url(), $url );
	}

	/**
	 * Customize the preview button in the WordPress admin.
	 *
	 * This function modifies the preview link for a post to point to a headless client setup.
	 *
	 * @param string  $link Original WordPress preview link.
	 * @param \WP_Post $post Current post object.
	 * @return string Modified headless preview link.
	 */
	function preview_link( string $link, \WP_Post $post ): string {
		// Update the preview link in WordPress.
		return add_query_arg(
			array(
				'id' => $post->ID,
				'token' => HEADLESS_SECRET,
			),
			esc_url_raw( esc_url_raw( HEADLESS_URL . "preview" ) )
		);
	}
}