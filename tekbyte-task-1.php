<?php
/**
 * Plugin Name:     Tekbyte Task 1
 * Plugin URI:      https://github.com/ahmad4372/tekbyte-task-1-backend
 * Description:     Registers a custom post type "Case Studies" with a custom taxonomy "Industry" and exposes it via WPGraphQL. Includes ACF fields and API enhancements for use in a headless setup.
 * Author:          Muhammad Ahmad
 * Author URI:      https://mahmad.xyz
 * Text Domain:     tekbyte-task-1
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Tekbyte_Task_1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TEKBYTE_TASK_1_VERSION', '0.1.0' );
define( 'TEKBYTE_TASK_1_PLUGIN_FILE', __FILE__ );
define( 'TEKBYTE_TASK_1_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'TEKBYTE_TASK_1_CLASSES_DIR', trailingslashit( TEKBYTE_TASK_1_PLUGIN_DIR . 'classes' ) );

// Bootstrap is intentionally loaded manually; all other classes are loaded via SPL autoload.
require_once TEKBYTE_TASK_1_CLASSES_DIR . 'Support/Singleton.php';
require_once TEKBYTE_TASK_1_CLASSES_DIR . 'Autoloader.php';
require_once TEKBYTE_TASK_1_CLASSES_DIR . 'Bootstrap.php';

\TekbyteTask1\Bootstrap::get_instance()->run();