<?php
/**
 * Meta Box Reusable WordPress Plugin
 *
 * @package     MetaBox
 * @author      hellofromTonya
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Meta Box Reusable WordPress Plugin
 * Plugin URI:  https://github.com/KnowTheCode/meta-box-basics
 * Description: Custom meta box reusable plugin using the ModularConfiguration pattern. Configure your meta box and build the custom view. Bam, your new meta box is rockin'.
 * Version:     1.0.0
 * Author:      hellofromTonya
 * Author URI:  https://KnowTheCode.io
 * Text Domain: mbreusable
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace KnowTheCode\MetaBox;

use KnowTheCode\Metadata as metaData;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

/**
 * Setup the plugin's constants.
 *
 * @since 1.0.0
 *
 * @return void
 */
function init_constants() {
	$plugin_url = plugin_dir_url( __FILE__ );
	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}

	define( 'METABOX_URL', $plugin_url );
	define( 'METABOX_DIR', plugin_dir_path( __FILE__ ) );
}

/**
 * Autoload the plugin's files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload_files() {
	$files = array(
		'/src/config-store/module.php',
		'/src/metadata/module.php'
	);

	foreach ( $files as $filename ) {
		require __DIR__ . $filename;
	}
}

/**
 * Launch the plugin
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	init_constants();

	autoload_files();

	// Load configurations
	metaData\autoload_configurations(
		array(
			__DIR__ . '/config/subtitle.php',
			__DIR__ . '/config/portfolio.php'
		)
	);
}

launch();
